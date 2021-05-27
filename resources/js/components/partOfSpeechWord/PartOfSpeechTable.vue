<template>
  <div>
    <div class="scroll-y">
      <!--Существительные-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.nouns"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.nouns = $event"
        :part-of-speech="partsOfSpeech.nouns">
      </BaseCasesTableComponent>
      <!--Прилагательные-->
      <AdjectiveCasesTableComponent
        v-if="partsOfSpeech.adjectives"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.adjectives = $event"
        :adjectives="partsOfSpeech.adjectives">
      </AdjectiveCasesTableComponent>
      <!--Глаголы-->
      <VerbWordComponent
        v-if="partsOfSpeech.verbs"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.verbs = $event"
        :verbs="partsOfSpeech.verbs">
      </VerbWordComponent>
      <!--Числительные-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.numerals"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.numerals = $event"
        :part-of-speech="partsOfSpeech.numerals">
      </BaseCasesTableComponent>
      <!--Порядковое числительное-->
      <BaseCasesFacesTableComponent
        v-if="partsOfSpeech.ordinals"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.ordinals = $event"
        :part-of-speech="partsOfSpeech.ordinals">
      </BaseCasesFacesTableComponent>
      <!--Местоимение-существительное-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.pronouns"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pronouns = $event"
        :part-of-speech="partsOfSpeech.pronouns">
      </BaseCasesTableComponent>
      <!--Местоимение-предикатив-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.pronounsPredicative"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pronounsPredicative = $event"
        :part-of-speech="partsOfSpeech.pronounsPredicative">
      </BaseCasesTableComponent>
      <!--Местоименное прилагательное-->
      <BaseCasesFacesTableComponent
        v-if="partsOfSpeech.pronominalAdjective"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pronominalAdjective = $event"
        :part-of-speech="partsOfSpeech.pronominalAdjective">
      </BaseCasesFacesTableComponent>
      <!--Наречие-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.adverbs"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.adverbs = $event"
        :part-of-speech="partsOfSpeech.adverbs">
      </UnchangeableWordComponent>
      <!--Предикатив-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.predicative"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.predicative = $event"
        :part-of-speech="partsOfSpeech.predicative">
      </UnchangeableWordComponent>
      <!--Предлог-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.pretext"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pretext = $event"
        :part-of-speech="partsOfSpeech.pretext">
      </UnchangeableWordComponent>
      <!--Союз-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.conjunction"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.conjunction = $event"
        :part-of-speech="partsOfSpeech.conjunction">
      </UnchangeableWordComponent>
      <!--Междометие-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.interjection"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.interjection = $event"
        :part-of-speech="partsOfSpeech.interjection">
      </UnchangeableWordComponent>
      <!--Частица-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.particle"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.particle = $event"
        :part-of-speech="partsOfSpeech.particle">
      </UnchangeableWordComponent>
      <!--Вводное слово-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.parenthesis"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.parenthesis = $event"
        :part-of-speech="partsOfSpeech.parenthesis">
      </UnchangeableWordComponent>
      <!--Фразеологизм-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.phrase"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.phrase = $event"
        :part-of-speech="partsOfSpeech.phrase">
      </UnchangeableWordComponent>

      <div class="d-flex align-items-center mt-2">
        <button class="btn btn-primary" type="button" @click="save" :disabled="saveResponse.loading">
          <template v-if="saveResponse.loading">
            <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
            Сохранение...
          </template>
          <template v-else>Сохранить</template>
        </button>
        <div class="ml-3"
             v-if="saveResponse.message">
          {{ saveResponse.message }}
        </div>
      </div>
    </div>
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
    },
    jestId: {
      type: Number,
      required: true
    },
    activeWordForms: {
      type: Array,
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
      },
      saveResponse: {
        loading: false,
        message: ''
      }
    }
  },
  methods: {
    getPartOfSpeechData(key) {
      return this.partsOfSpeechWord && this.partsOfSpeechWord[key] ? this.partsOfSpeechWord[key] : null
    },
    save() {
      this.selectedWords.all = this.uniqueWords();

      this.saveResponse.loading = true;
      this.$emit('saving-wordForms', this.saveResponse.loading);

      axios.post('/api/storeWordFormsInJest', {
        jest_id: this.jestId,
        wordForms: JSON.stringify(this.selectedWords.all)
      }).then(response => {
        this.saveResponse.loading = false;
        if (response.status === 200) {
          this.saveResponse.message = 'Словоформы успешно сохранены';

          setTimeout(() => {
            this.saveResponse.message = '';
          }, 5000);
        }

        this.$emit('saving-wordForms', this.saveResponse.loading);
      }).catch(error => {
        this.saveResponse.loading = false;
        this.saveResponse.message = error;
      });
    },
    uniqueWords() {
      return uniqueWords.call(this);
    }
  }
}
</script>

<style lang="scss">
.equals {
  color: red;
  font-weight: 600;

  .d-flex::after {
    content: url('/images/check_small.png');
    margin-right: 0;
    margin-left: 10px;
    position: relative;
    top: 2px;
  }
}

.form-check-inline {
  margin-right: 0;
}

.scroll-y {
  height: 600px;
  overflow-y: scroll;
}
</style>
