<template>
  <div>
    <hr>
    <div v-if="partOfSpeech" v-for="wordTemp in Object.keys(partOfSpeech)">
      <div class="py-3"><b>Базовая форма</b>: <span class="equals">{{ wordTemp }}</span> -
        {{ listOfGrammems(partOfSpeech[wordTemp]['Граммемы']) }}
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
        <tr v-for="casePart in Object.keys(partOfSpeech[wordTemp]['Падежи'])">
          <th scope="row">{{ casePart }}</th>
          <td :class="{ equals: equalsWithWord(partOfSpeech[wordTemp]['Падежи'][casePart]['ЕД']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[wordTemp]['Падежи'][casePart]['ЕД']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(partOfSpeech[wordTemp]['Падежи'][casePart]['ЕД'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ partOfSpeech[wordTemp]['Падежи'][casePart]['ЕД']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(partOfSpeech[wordTemp]['Падежи'][casePart]['МН']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[wordTemp]['Падежи'][casePart]['МН']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(partOfSpeech[wordTemp]['Падежи'][casePart]['МН'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ partOfSpeech[wordTemp]['Падежи'][casePart]['МН']['Слово'].toLowerCase() }}
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsMixin} from "../../../mixins/grammems";
import {SelectedWordsMixin} from "../../../mixins/selectedWords";
import {arraysEqual, objectEquals} from "../../../services/heplService";

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
  mixins: [GrammemsMixin, SelectedWordsMixin]
}
</script>

<style scoped>

</style>
