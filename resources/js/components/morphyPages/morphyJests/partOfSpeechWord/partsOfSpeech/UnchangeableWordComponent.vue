<template>
  <div>
    <hr>
    <div v-for="baseWord in Object.keys(partOfSpeech)">
      <div class="py-3 d-flex align-items-center"><b>Базовая форма</b>: <span
        class="equals mx-2">{{ partOfSpeech[baseWord]['Информация']['Слово'] }}</span> -
        {{ descriptorToPartOfSpeech(partOfSpeech[baseWord]['Информация']['Часть речи']) }} {{
          listOfGrammems(partOfSpeech[baseWord]['Информация']['Граммемы'])
        }}, неизменяемое слово.
        <div v-if="!isEmptyWord(baseWord.toLowerCase()) && (!partOfSpeech[baseWord]['Жесты'] || !selectJests)"
             class="d-inline-flex pl-2">
          <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox"
                   :data-base-word-form="baseWord"
                   :value="JSON.stringify(partOfSpeech[baseWord]['Информация'])"
                   v-model="selectedWords">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {GrammemsMixin} from "../../../../../mixins/grammems";
import {SelectedWordsMixin} from "../../../../../mixins/selectedWords";
import {SelectJestsMixin} from "../../../../../mixins/selectedJests";

export default {
  name: "UnchangeableWordComponent",
  props: {
    partOfSpeech: {
      type: Object,
      required: true
    },
    word: {
      type: String,
      required: true
    }
  },
  mixins: [GrammemsMixin, SelectedWordsMixin, SelectJestsMixin]
}
</script>

<style scoped>

</style>
