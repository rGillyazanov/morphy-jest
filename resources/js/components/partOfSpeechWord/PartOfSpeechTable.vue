<template>
  <div>
    <!--Существительные-->
    <BaseCasesTableComponent
      v-if="nouns"
      :word="word"
      :part-of-speech="nouns">
    </BaseCasesTableComponent>
    <!--Прилагательные-->
    <AdjectiveCasesTableComponent
      v-if="adjectives"
      :word="word"
      :adjectives="adjectives">
    </AdjectiveCasesTableComponent>
    <!--Глаголы-->
    <VerbWordComponent
      v-if="verbs"
      :word="word"
      :verbs="verbs">
    </VerbWordComponent>
    <!--Числительные-->
    <BaseCasesTableComponent
      v-if="numerals"
      :word="word"
      :part-of-speech="numerals">
    </BaseCasesTableComponent>
    <!--Порядковое числительное-->
    <BaseCasesFacesTableComponent
      v-if="ordinals"
      :word="word"
      :part-of-speech="ordinals">
    </BaseCasesFacesTableComponent>
    <!--Местоимение-существительное-->
    <BaseCasesTableComponent
      v-if="pronouns"
      :word="word"
      :part-of-speech="pronouns">
    </BaseCasesTableComponent>
    <!--Местоимение-предикатив-->
    <BaseCasesTableComponent
      v-if="pronounsPredicative"
      :word="word"
      :part-of-speech="pronounsPredicative">
    </BaseCasesTableComponent>
    <!--Местоименное прилагательное-->
    <BaseCasesFacesTableComponent
      v-if="pronominalAdjective"
      :word="word"
      :part-of-speech="pronominalAdjective">
    </BaseCasesFacesTableComponent>
    <!--Наречие-->
    <UnchangeableWordComponent
      v-if="adverbs"
      :word="word"
      :part-of-speech="adverbs">
    </UnchangeableWordComponent>
    <!--Предикатив-->
    <UnchangeableWordComponent
      v-if="predicative"
      :word="word"
      :part-of-speech="predicative">
    </UnchangeableWordComponent>
    <!--Предлог-->
    <UnchangeableWordComponent
      v-if="pretext"
      :word="word"
      :part-of-speech="pretext">
    </UnchangeableWordComponent>
    <!--Союз-->
    <UnchangeableWordComponent
      v-if="conjunction"
      :word="word"
      :part-of-speech="conjunction">
    </UnchangeableWordComponent>
    <!--Междометие-->
    <UnchangeableWordComponent
      v-if="interjection"
      :word="word"
      :part-of-speech="interjection">
    </UnchangeableWordComponent>
    <!--Частица-->
    <UnchangeableWordComponent
      v-if="particle"
      :word="word"
      :part-of-speech="particle">
    </UnchangeableWordComponent>
    <!--Вводное слово-->
    <UnchangeableWordComponent
      v-if="parenthesis"
      :word="word"
      :part-of-speech="parenthesis">
    </UnchangeableWordComponent>
    <!--Фразеологизм-->
    <UnchangeableWordComponent
      v-if="phrase"
      :word="word"
      :part-of-speech="phrase">
    </UnchangeableWordComponent>
  </div>
</template>

<script>
import BaseCasesTableComponent from "./partsOfSpeech/BaseCasesTableComponent";
import VerbWordComponent from "./partsOfSpeech/VerbWordComponent";
import FacesCasesTableComponent from "./partsOfSpeech/ParticipleCasesTableComponent";
import BaseCasesFacesTableComponent from "./partsOfSpeech/BaseCasesFacesTableComponent";
import UnchangeableWordComponent from "./partsOfSpeech/UnchangeableWordComponent";
import AdjectiveCasesTableComponent from "./partsOfSpeech/AdjectiveCasesTableComponent";

export default {
  name: "PartOfSpeechTable",
  components: {
    AdjectiveCasesTableComponent,
    UnchangeableWordComponent,
    BaseCasesFacesTableComponent,
    FacesCasesTableComponent,
    VerbWordComponent,
    BaseCasesTableComponent
  },
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
      adjectives: this.partsOfSpeechWord && this.partsOfSpeechWord['Прилагательные'] ? this.partsOfSpeechWord['Прилагательные'] : null,
      verbs: this.partsOfSpeechWord && this.partsOfSpeechWord['Глаголы'] ? this.partsOfSpeechWord['Глаголы'] : null,
      numerals: this.partsOfSpeechWord && this.partsOfSpeechWord['Числительные'] ? this.partsOfSpeechWord['Числительные'] : null,
      ordinals: this.partsOfSpeechWord && this.partsOfSpeechWord['Порядковые числительные'] ? this.partsOfSpeechWord['Порядковые числительные'] : null,
      pronouns: this.partsOfSpeechWord && this.partsOfSpeechWord['Местоимение-существительное'] ? this.partsOfSpeechWord['Местоимение-существительное'] : null,
      pronounsPredicative: this.partsOfSpeechWord && this.partsOfSpeechWord['Местоимение-предикатив'] ? this.partsOfSpeechWord['Местоимение-предикатив'] : null,
      pronominalAdjective: this.partsOfSpeechWord && this.partsOfSpeechWord['Местоименное прилагательное'] ? this.partsOfSpeechWord['Местоименное прилагательное'] : null,
      adverbs: this.partsOfSpeechWord && this.partsOfSpeechWord['Наречие'] ? this.partsOfSpeechWord['Наречие'] : null,
      predicative: this.partsOfSpeechWord && this.partsOfSpeechWord['Предикатив'] ? this.partsOfSpeechWord['Предикатив'] : null,
      pretext: this.partsOfSpeechWord && this.partsOfSpeechWord['Предлог'] ? this.partsOfSpeechWord['Предлог'] : null,
      conjunction: this.partsOfSpeechWord && this.partsOfSpeechWord['Союз'] ? this.partsOfSpeechWord['Союз'] : null,
      interjection: this.partsOfSpeechWord && this.partsOfSpeechWord['Междометие'] ? this.partsOfSpeechWord['Междометие'] : null,
      particle: this.partsOfSpeechWord && this.partsOfSpeechWord['Частица'] ? this.partsOfSpeechWord['Частица'] : null,
      parenthesis: this.partsOfSpeechWord && this.partsOfSpeechWord['Вводное слово'] ? this.partsOfSpeechWord['Вводное слово'] : null,
      phrase: this.partsOfSpeechWord && this.partsOfSpeechWord['Фразеологизм'] ? this.partsOfSpeechWord['Фразеологизм'] : null,
    }
  }
}
</script>

<style>
  .equals {
    color: red;
  }
</style>
