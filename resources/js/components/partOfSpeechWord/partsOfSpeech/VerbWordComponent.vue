<template>
  <div>
    <div v-for="(verb, index) in Object.keys(verbs)">
      <div class="py-3">{{ index + 1 }}. <b>Базовая форма</b>: {{ verb }} - {{
          listOfGrammems(verbs[verb]['Граммемы'])
        }}
      </div>
      <PresentTimeTableComponent
        :word="word"
        :present-time="presentTime(verb)">
      </PresentTimeTableComponent>
      <PastTimeTableComponent
        :word="word"
        :past-time="pastTime(verb)">
      </PastTimeTableComponent>
      <ImperativeMoodTableComponent
        :word="word"
        :imperative-mood="imperativeMood(verb)">
      </ImperativeMoodTableComponent>
      <AdverbParticipleTableComponent
        :word="word"
        :adverb-participle="adverbParticiple(verb)">
      </AdverbParticipleTableComponent>
      <ParticipleTableComponent
        :word="word"
        :participle="participle(verb)">
      </ParticipleTableComponent>
    </div>
  </div>
</template>

<script>
import PresentTimeTableComponent from "./PresentTimeTableComponent";
import {GrammemsService} from "../../../mixins/grammems";
import PastTimeTableComponent from "./PastTimeTableComponent";
import ImperativeMoodTableComponent from "./ImperativeMoodTableComponent";
import AdverbParticipleTableComponent from "./AdverbParticipleTableComponent";
import ParticipleTableComponent from "./ParticipleTableComponent";

export default {
  name: "VerbWordComponent",
  components: {
    ParticipleTableComponent,
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
    }
  },
  mixins: [GrammemsService],
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
    }
  }
}
</script>

<style scoped>

</style>
