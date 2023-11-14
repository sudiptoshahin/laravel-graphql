<script>
import AllNotes from '@/components/AllNotes.vue'

export default {
    name: "NotesHome",
    components: {
        'all-note': AllNotes
    },
    data(){
        return {}
    },
    setup() {

    }
}

</script>

<template>
    <div>
        <all-note />
    </div>
</template>

<style scoped>

</style>