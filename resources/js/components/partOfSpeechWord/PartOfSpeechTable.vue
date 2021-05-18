<template>
  <div>
    <!--Существительные-->
    <BaseCasesTableComponent
      v-if="partsOfSpeech.nouns"
      :word="word"
      @selected-words="selectedWords.nouns = $event"
      :part-of-speech="partsOfSpeech.nouns">
    </BaseCasesTableComponent>
    <!--Прилагательные-->
    <AdjectiveCasesTableComponent
      v-if="partsOfSpeech.adjectives"
      :word="word"
      @selected-words="selectedWords.adjectives = $event"
      :adjectives="partsOfSpeech.adjectives">
    </AdjectiveCasesTableComponent>
    <!--Глаголы-->
    <VerbWordComponent
      v-if="partsOfSpeech.verbs"
      :word="word"
      @selected-words="selectedWords.verbs = $event"
      :verbs="partsOfSpeech.verbs">
    </VerbWordComponent>
    <!--Числительные-->
    <BaseCasesTableComponent
      v-if="partsOfSpeech.numerals"
      :word="word"
      @selected-words="selectedWords.numerals = $event"
      :part-of-speech="partsOfSpeech.numerals">
    </BaseCasesTableComponent>
    <!--Порядковое числительное-->
    <BaseCasesFacesTableComponent
      v-if="partsOfSpeech.ordinals"
      :word="word"
      @selected-words="selectedWords.ordinals = $event"
      :part-of-speech="partsOfSpeech.ordinals">
    </BaseCasesFacesTableComponent>
    <!--Местоимение-существительное-->
    <BaseCasesTableComponent
      v-if="partsOfSpeech.pronouns"
      :word="word"
      @selected-words="selectedWords.pronouns = $event"
      :part-of-speech="partsOfSpeech.pronouns">
    </BaseCasesTableComponent>
    <!--Местоимение-предикатив-->
    <BaseCasesTableComponent
      v-if="partsOfSpeech.pronounsPredicative"
      :word="word"
      @selected-words="selectedWords.pronounsPredicative = $event"
      :part-of-speech="partsOfSpeech.pronounsPredicative">
    </BaseCasesTableComponent>
    <!--Местоименное прилагательное-->
    <BaseCasesFacesTableComponent
      v-if="partsOfSpeech.pronominalAdjective"
      :word="word"
      @selected-words="selectedWords.pronominalAdjective = $event"
      :part-of-speech="partsOfSpeech.pronominalAdjective">
    </BaseCasesFacesTableComponent>
    <!--Наречие-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.adverbs"
      :word="word"
      @selected-words="selectedWords.adverbs = $event"
      :part-of-speech="partsOfSpeech.adverbs">
    </UnchangeableWordComponent>
    <!--Предикатив-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.predicative"
      :word="word"
      @selected-words="selectedWords.predicative = $event"
      :part-of-speech="partsOfSpeech.predicative">
    </UnchangeableWordComponent>
    <!--Предлог-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.pretext"
      :word="word"
      @selected-words="selectedWords.pretext = $event"
      :part-of-speech="partsOfSpeech.pretext">
    </UnchangeableWordComponent>
    <!--Союз-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.conjunction"
      :word="word"
      @selected-words="selectedWords.conjunction = $event"
      :part-of-speech="partsOfSpeech.conjunction">
    </UnchangeableWordComponent>
    <!--Междометие-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.interjection"
      :word="word"
      @selected-words="selectedWords.interjection = $event"
      :part-of-speech="partsOfSpeech.interjection">
    </UnchangeableWordComponent>
    <!--Частица-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.particle"
      :word="word"
      @selected-words="selectedWords.particle = $event"
      :part-of-speech="partsOfSpeech.particle">
    </UnchangeableWordComponent>
    <!--Вводное слово-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.parenthesis"
      :word="word"
      @selected-words="selectedWords.parenthesis = $event"
      :part-of-speech="partsOfSpeech.parenthesis">
    </UnchangeableWordComponent>
    <!--Фразеологизм-->
    <UnchangeableWordComponent
      v-if="partsOfSpeech.phrase"
      :word="word"
      @selected-words="selectedWords.phrase = $event"
      :part-of-speech="partsOfSpeech.phrase">
    </UnchangeableWordComponent>
    <button type="button" @click="show">Words</button>
  </div>
</template>

<script>
import BaseCasesTableComponent from "./partsOfSpeech/BaseCasesTableComponent";
import VerbWordComponent from "./partsOfSpeech/VerbWordComponent";
import FacesCasesTableComponent from "./partsOfSpeech/ParticipleCasesTableComponent";
import BaseCasesFacesTableComponent from "./partsOfSpeech/BaseCasesFacesTableComponent";
import UnchangeableWordComponent from "./partsOfSpeech/UnchangeableWordComponent";
import AdjectiveCasesTableComponent from "./partsOfSpeech/AdjectiveCasesTableComponent";

import {uniqueWords} from "../../mixins/selectedWords";

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
      partsOfSpeech: {
        nouns: this.getPartOfSpeechData('Существительные'),
        adjectives: this.getPartOfSpeechData('Прилагательные'),
        verbs: this.getPartOfSpeechData('Глаголы'),
        numerals: this.getPartOfSpeechData('Числительные'),
        ordinals: this.getPartOfSpeechData('Порядковые числительные'),
        pronouns: this.getPartOfSpeechData('Местоимение-существительное'),
        pronounsPredicative: this.getPartOfSpeechData('Местоимение-предикатив'),
        pronominalAdjective: this.getPartOfSpeechData('Местоименное прилагательное'),
        adverbs: this.getPartOfSpeechData('Наречие'),
        predicative: this.getPartOfSpeechData('Предикатив'),
        pretext: this.getPartOfSpeechData('Предлог'),
        conjunction: this.getPartOfSpeechData('Союз'),
        interjection: this.getPartOfSpeechData('Междометие'),
        particle: this.getPartOfSpeechData('Частица'),
        parenthesis: this.getPartOfSpeechData('Вводное слово'),
        phrase: this.getPartOfSpeechData('Фразеологизм')
      },
      selectedWords: {
        nouns: [],
        adjectives: [],
        verbs: [],
        numerals: [],
        ordinals: [],
        pronouns: [],
        pronounsPredicative: [],
        pronominalAdjective: [],
        adverbs: [],
        predicative: [],
        pretext: [],
        conjunction: [],
        interjection: [],
        particle: [],
        parenthesis: [],
        phrase: [],
        all: []
      }
    }
  },
  methods: {
    getPartOfSpeechData(key) {
      return this.partsOfSpeechWord && this.partsOfSpeechWord[key] ? this.partsOfSpeechWord[key] : null
    },
    show() {
      this.selectedWords.all = this.uniqueWords();
      console.log(this.selectedWords.all);
      axios.post('/api/words', {
        words: JSON.stringify(this.selectedWords.all)
      });
    },
    uniqueWords() {
      return uniqueWords.call(this);
    }
  }
}
</script>

<style>
.equals {
  color: red;
}
</style>
