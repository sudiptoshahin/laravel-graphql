
<script>
import { ref } from 'vue';
import gql from 'graphql-tag'
import { useQuery, useMutation } from '@vue/apollo-composable';

export default {
    name: "SingleNote",
    components: {},
    data() {
        return {
            showEditSection: false,
        }
    },
    mounted() {
        this.variables = {
            id: this.$route.params.noteId
        };
    },
    methods: {
        handleEditSection() {
            this.showEditSection = !this.showEditSection;
        },

        handleUpdateNote() {
            if(this.noteTitle !== undefined || this.noteText !== undefined) {
                const payload = {
                    'id': this.$route.params.noteId, 
                    'title': this.noteTitle, 
                    'text': this.noteText
                }
                this.updateNote(payload);
            }
            window.location.reload();
        }
    },
    setup() {
        const noteTitle = ref();
        const noteText = ref();
        const variables = ref();
        const data = ref();

        const { result } = useQuery(gql`
            query getNoteById($id: ID!) {
                getNoteById(id: $id) {
                    id
                    title
                    text
                }
            }
        `, variables);

        // mutation
        const { mutate: updateNote } = useMutation(gql`
                mutation updateNote ($id: ID!, $title: String!, $text: String!) {
                    updateNote (id: $id, title: $title, text: $text) {
                        title
                        text
                    }
                }
            `
        );

        noteTitle.value = result?.getNoteById?.title;
        noteText.value = result?.getNoteById?.text;

        return {
            noteTitle,
            noteText,
            variables,
            data,
            result,
            updateNote
        }
    }
}

</script>

<template>
    <div class="content">
        <h1>Note</h1>
        <hr>

        <div class="input-section">
            <div class="inputs" v-if="showEditSection == true && noteTitle !== ''">
                <input type="text" class="input-title" name="title" placeholder="Title" v-model.lazy="noteTitle" />
                <input type="text" class="input-text" name="text" placeholder="Text" v-model.lazy="noteText" />

                <button @click="handleUpdateNote">Update note</button>
            </div>
        </div>

        <div class="mt-10">
            <div class="note">
                <span class="edit" @click="handleEditSection">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 20 20">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </span>
                <div class="title">{{ result?.getNoteById.title }}</div>
                <div class="text">{{ result?.getNoteById.text }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.input-section {
    height: 50px;
}

.inputs button,
.inputs input {
    margin: 5px;
    font-size: 16px;
    font-weight: 700;
}

.inputs button {
    height: 35px;
    width: 150px;
    border: none;
    background-color: rgb(32, 120, 197);
    color: white;
    cursor: pointer;
}

.inputs input {
    height: 30px;
    text-indent: 10px;
}

.edit {
    display: block;
    position: absolute;
    right: -20px;
    top: -10px;
    cursor: pointer;
}

.mt-10 {
    margin-top: 50px;
}

.note {
    background-color: lightgreen;
    height: 500px;
    width: 600px;
    margin: auto;
    filter: drop-shadow(5px 5px 10px #2ad9a4);
    position: relative;
}

.title {
    padding: 25px 0;
    margin: 5px 30px;
    font-size: 25px;
    font-weight: 700;
    border: 1px solid black;
}

.text {
    padding: 0 10px;
    margin-top: 30px;
    font-size: 18px;
}
</style>