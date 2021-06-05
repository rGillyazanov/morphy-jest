<template>
  <div>
    <hr>
    <div v-if="adverbParticiple">
      <h4 class="text-center">Деепричаcтие</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th>Настоящее</th>
          <th>Прошедшее</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td :class="{ equals: equalsWithWord(adverbParticiple['Настоящее']['Информация']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(adverbParticiple['Настоящее']['Информация']['Слово'].toLowerCase()) &&
                         (!adverbParticiple['Настоящее']['Жесты'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWordForm"
                         :value="JSON.stringify(adverbParticiple['Настоящее']['Информация'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ adverbParticiple['Настоящее']['Информация']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(adverbParticiple['Прошедшее']['Информация']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(adverbParticiple['Прошедшее']['Информация']['Слово'].toLowerCase()) &&
                         (!adverbParticiple['Прошедшее']['Жесты'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWordForm"
                         :value="JSON.stringify(adverbParticiple['Прошедшее']['Информация'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ adverbParticiple['Прошедшее']['Информация']['Слово'].toLowerCase() }}
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsMixin} from "../../../../../mixins/grammems";
import {SelectedWordsMixin} from "../../../../../mixins/selectedWords";
import {BaseWordFormPropMixin} from "../../../../../mixins/baseWordFormProp";
import {SelectJestsMixin} from "../../../../../mixins/selectedJests";

export default {
  name: "AdverbParticipleTableComponent",
  props: {
    adverbParticiple: {
      type: Object,
      required: true
    },
    word: {
      type: String,
      required: true
    }
  },
  mixins: [GrammemsMixin, SelectedWordsMixin, BaseWordFormPropMixin, SelectJestsMixin]
}
</script>

<style scoped>

</style>
