<template>
  <div>
    <!--Существительные-->
    <BaseCasesTableComponent
      v-if="nouns"
      :word="word"
      :part-of-speech="nouns">
    </BaseCasesTableComponent>
    <!--Глаголы-->
    <VerbWordComponent
      v-if="verbs"
      :word="word"
      :verbs="verbs">
    </VerbWordComponent>
  </div>
</template>

<script>
import BaseCasesTableComponent from "./partsOfSpeech/BaseCasesTableComponent";
import VerbWordComponent from "./partsOfSpeech/VerbWordComponent";

export default {
  name: "PartOfSpeechTable",
  components: {VerbWordComponent, BaseCasesTableComponent},
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
      nouns: this.partsOfSpeechWord && this.partsOfSpeechWord['Существительные'] ? this.partsOfSpeechWord['Существительные'] : null,
      verbs: this.partsOfSpeechWord && this.partsOfSpeechWord['Глаголы'] ? this.partsOfSpeechWord['Глаголы'] : null,
    }
  }
}
</script>

<style>
  .equals {
    color: red;
  }
</style>
