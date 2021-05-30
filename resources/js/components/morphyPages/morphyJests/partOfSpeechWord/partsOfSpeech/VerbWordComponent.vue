<template>
  <div>
    <hr>
    <div v-for="verb in Object.keys(verbs)">
      <div class="py-3"><b>Базовая форма</b>: {{ verb }} - {{
          listOfGrammems(verbs[verb]['Граммемы'])
        }}
      </div>
      <PresentTimeTableComponent
        :word="word"
        :active-word-forms="activeWordForms"
        @selected-words="selectedWords.presentTime = $event"
        :present-time="presentTime(verb)">
      </PresentTimeTableComponent>
      <PastTimeTableComponent
        :word="word"
        :active-word-forms="activeWordForms"
        @selected-words="selectedWords.pastTime = $event"
        :past-time="pastTime(verb)">
      </PastTimeTableComponent>
      <ImperativeMoodTableComponent
        :word="word"
        :active-word-forms="activeWordForms"
        @selected-words="selectedWords.imperativeMood = $event"
        :imperative-mood="imperativeMood(verb)">
      </ImperativeMoodTableComponent>
      <AdverbParticipleTableComponent
        :word="word"
        :active-word-forms="activeWordForms"
        @selected-words="selectedWords.adverbParticiple = $event"
        :adverb-participle="adverbParticiple(verb)">
      </AdverbParticipleTableComponent>
      <ParticipleCasesTableComponent
        :word="word"
        :active-word-forms="activeWordForms"
        @selected-words="selectedWords.participle = $event"
        :part-of-speech="participle(verb)">
      </ParticipleCasesTableComponent>
    </div>
  </div>
</template>

<script>
import {GrammemsMixin} from "../../../../../mixins/grammems";

import PresentTimeTableComponent from "./PresentTimeTableComponent";
import PastTimeTableComponent from "./PastTimeTableComponent";
import ImperativeMoodTableComponent from "./ImperativeMoodTableComponent";
import AdverbParticipleTableComponent from "./AdverbParticipleTableComponent";
import ParticipleCasesTableComponent from "./ParticipleCasesTableComponent";
import {uniqueWords} from "../../../../../mixins/selectedWords";

export default {
  name: "VerbWordComponent",
  components: {
    ParticipleCasesTableComponent,
    AdverbParticipleTableComponent,
    ImperativeMoodTableComponent, PastTimeTableComponent, PresentTimeTableComponent},
  props: {
    verbs: {
      type: Object,
      required: true
    },
    word: {
      type: String,
      required: true
    },
    activeWordForms: {
      type: Array,
      required: true
    }
  },
  mixins: [GrammemsMixin],
  data() {
    return {
      selectedWords: {
        presentTime: [],
        pastTime: [],
        imperativeMood: [],
        adverbParticiple: [],
        participle: []
      }
    }
  },
  watch: {
    selectedWords: {
      deep: true,
      handler() {
        this.$emit('selected-words', this.uniqueWords());
      }
    }
  },
  methods: {
    presentTime(word) {
      return this.verbs[word]['Время']['Настоящее'];
    },
    pastTime(word) {
      return this.verbs[word]['Время']['Прошедшее'];
    },
    imperativeMood(word) {
      return this.verbs[word]['Повелительное наклонение']
    },
    adverbParticiple(word) {
      return this.verbs[word]['Деепричастие']
    },
    participle(word) {
      return this.verbs[word]['Причастие']
    },
    uniqueWords() {
      return uniqueWords.call(this);
    }
  }
}
</script>

<style scoped>

</style>
