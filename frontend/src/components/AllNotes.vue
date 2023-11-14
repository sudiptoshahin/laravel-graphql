
<template>
    <div class="container">
        <h2>Hello GraphQL</h2>
        <hr>


        <div class="inputs">
            <input type="text" class="input-title" name="title" placeholder="Title" v-model.lazy="noteTitle" />
            <input type="text" class="input-text" name="text" placeholder="Text" v-model.lazy="noteText" />
            <input type="text" class="input-author" name="author" placeholder="Author id" v-model.lazy="noteAuthor" />
            <button @click="handleAddNew">Add note</button>
        </div>

        <div class="grid-container" v-for="(note, idx) in result?.notes" :key="idx">
            <div class="card grid-item" :class="[idx % 2 === 0 ? 'blue' : 'green']">
                <span class="del-note" @click.stop="handleNoteDelete(note.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </span>
                <router-link :to="{ name: 'note', params: { 'noteId': note.id } }">
                    <div class="title">{{ note.title }}</div>
                </router-link>

                <div class="text">
                    {{ note.text }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import gql from 'graphql-tag'
import { useQuery, useMutation } from '@vue/apollo-composable';
import { ref } from 'vue';

export default {
    name: "AllNotes",
    components: {},
    data() {
        return {
            users: [],
            user: null,
        }
    },

    methods: {

        refreshPage() {
            window.location.reload();
            return;
        },

        handleNoteDelete(noteId) {
            if(noteId !== null || noteId !== "") {
                const tempNoteId = parseInt(noteId);
                const payload = {
                    id: tempNoteId
                }
                const deletedNote = this.deleteNote(payload);
                console.log('delete: ', deletedNote);
                this.refreshPage();
            }
        },

        handleAddNew() {

            if (this.noteTitle !== '' || this.noteText !== "" || this.noteAuthor > 0) {
                const payload = {
                    title: this.noteTitle,
                    text: this.noteText,
                    user_id: this.noteAuthor
                }
                this.createNote(payload);
                this.refreshPage();
            }
        }
    },

    setup() {

        const noteTitle = ref("");
        const noteText = ref("");
        const noteAuthor = ref();

        const { result } = useQuery(gql`
            query notes {
                notes {
                    id
                    title
                    text
                }
            }
        `);

        const { mutate: createNote } = useMutation(gql`
                mutation createNote ($title: String!, $text: String!, $user_id: ID!) {
                    createNote (title: $title, text: $text, user_id: $user_id) {
                        title
                        text
                    }
                }
            `,
            // optional
            // {
            //     variables: {
            //         title: noteTitle.value,
            //         text: noteText.value,
            //         author: noteAuthor.value
            //     }
            // }
        );

        const { mutate: deleteNote } = useMutation(gql`
            mutation deleteNote ($id: ID!) {
                deleteNote (id: $id) {
                    title
                }
            }
        `);

        return {
            result,
            // handleAddNew,
            createNote,
            noteTitle,
            noteText,
            noteAuthor,
            deleteNote
        }
    }
}

</script>

<style scoped>

.del-note {
    display: block;
    position: absolute;
    right: -10px;
    top: -20px;
    cursor: pointer;
}
.inputs button,
.inputs input {
    margin: 5px;
    font-size: 16px;
    font-weight: 700;
}

.inputs button {
    height: 35px;
    width: 100px;
    border: none;
    background-color: rgb(32, 120, 197);
    color: white;
    cursor: pointer;
}

.inputs input {
    height: 30px;
    text-indent: 10px;
}

.blue {
    background-color: lightblue;
}

.green {
    background-color: lightgreen;
}

.yellow {
    background-color: rgb(208, 243, 136);
}

.grid-container {
    display: inline-grid;
    grid-template-columns: auto auto auto;
    padding: 10px;
}

.grid-item {
    padding: 20px;
    font-size: 30px;
    text-align: center;
}

.card {
    position: relative;
    width: 300px;
    height: auto;
    margin: 10px;
}

.title {
    font-size: 18px;
    font-weight: 700;
    color: rgb(47, 47, 47);
    border: 1px solid black;
    padding: 10px 0px;
    margin: 5px;
}

.text {
    font-size: 14px;
    color: rgb(47, 47, 47);
    letter-spacing: 1px;
    cursor: default;
}
</style>