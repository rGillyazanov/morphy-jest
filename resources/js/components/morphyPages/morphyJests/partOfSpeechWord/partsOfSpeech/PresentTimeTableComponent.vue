<template>
  <div>
    <div v-if="presentTime">
      <h4 class="text-center">Настоящее время</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th scope="col">Лицо</th>
          <th scope="col">Единственное число</th>
          <th scope="col">Множественное число</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="face in Object.keys(presentTime)">
          <th scope="row">{{ face }}</th>
          <td :class="{ equals: equalsWithWord(presentTime[face]['ЕД']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(presentTime[face]['ЕД']['Слово'].toLowerCase()) &&
                         (!presentTime[face]['ЖЕСТЫ']['ЕД'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWordForm"
                         :value="JSON.stringify(presentTime[face]['ЕД'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{
                presentTime[face]['ЕД']['Слово'].toLowerCase()
              }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(presentTime[face]['МН']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(presentTime[face]['МН']['Слово'].toLowerCase()) &&
                         (!presentTime[face]['ЖЕСТЫ']['МН'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWordForm"
                         :value="JSON.stringify(presentTime[face]['МН'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{
                presentTime[face]['МН']['Слово'].toLowerCase()
              }}
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
  name: "PresentTimeTableComponent",
  props: {
    presentTime: {
      type: Object | null,
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
