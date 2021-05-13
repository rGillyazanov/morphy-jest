<template>
    <NounWordComponent v-if="nouns" :nouns="nouns"></NounWordComponent>
</template>

<script>
import NounWordComponent from "./partsOfSpeech/NounWordComponent";
export default {
    name: "PartOfSpeechTable",
    components: {NounWordComponent},
    props: {
        partsOfSpeechWord: Object
    },
    data() {
        return {
            nouns: this.partsOfSpeechWord && this.partsOfSpeechWord['Существительные'] ? this.partsOfSpeechWord['Существительные'] : null
        }
    }
}
</script>

<style scoped>

</style>
