<template>
    <NounWordComponent
        v-if="nouns"
        :word="word"
        :nouns="nouns">
    </NounWordComponent>
</template>

<script>
import NounWordComponent from "./partsOfSpeech/NounWordComponent";
export default {
    name: "PartOfSpeechTable",
    components: {NounWordComponent},
    props: {
        word: {
            type: String,
            required: true
        },
        partsOfSpeechWord: {
            type: Object,
            required: true
        }
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
