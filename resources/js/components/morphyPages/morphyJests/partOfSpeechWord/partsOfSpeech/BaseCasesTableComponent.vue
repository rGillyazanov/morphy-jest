<template>
  <div>
    <hr>
    <div v-if="partOfSpeech" v-for="baseWord in Object.keys(partOfSpeech)">
      <div class="py-3"><b>Базовая форма</b>: <span class="equals">{{ baseWord }}</span> -
        {{ listOfGrammems(partOfSpeech[baseWord]['Граммемы']) }}
      </div>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th scope="col">Падеж</th>
          <th scope="col">Единственное число</th>
          <th scope="col">Множественное число</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="casePart in Object.keys(partOfSpeech[baseWord]['Падежи'])">
          <th scope="row">{{ casePart }}</th>
          <td :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][casePart]['ЕД']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[baseWord]['Падежи'][casePart]['ЕД']['Слово'].toLowerCase()) &&
                         (!partOfSpeech[baseWord]['Падежи'][casePart]['Жесты']['ЕД'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWord"
                         :value="JSON.stringify(partOfSpeech[baseWord]['Падежи'][casePart]['ЕД'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ partOfSpeech[baseWord]['Падежи'][casePart]['ЕД']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][casePart]['МН']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[baseWord]['Падежи'][casePart]['МН']['Слово'].toLowerCase()) &&
                         (!partOfSpeech[baseWord]['Падежи'][casePart]['Жесты']['МН'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWord"
                         :value="JSON.stringify(partOfSpeech[baseWord]['Падежи'][casePart]['МН'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ partOfSpeech[baseWord]['Падежи'][casePart]['МН']['Слово'].toLowerCase() }}
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
import {SelectJestsMixin} from "../../../../../mixins/selectedJests";

export default {
  name: "BaseCasesTableComponent",
  props: {
    partOfSpeech: {
      type: Object | null,
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
