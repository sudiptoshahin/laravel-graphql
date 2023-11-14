<script>
export default {
    name: "EditNote",
    components: {},
    data() {
        return {}
    },
    setup() {

    }
}
</script>

<template>
    <div class="note-edit">
        <div class="input-section">
            <div class="inputs" v-if="showEditSection == true">
                <input type="text" class="input-title" name="title" placeholder="Title" v-model.lazy="noteTitle" />
                <input type="text" class="input-text" name="text" placeholder="Text" v-model.lazy="noteText" />

                <button @click="handleUpdateNote">Update note</button>
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