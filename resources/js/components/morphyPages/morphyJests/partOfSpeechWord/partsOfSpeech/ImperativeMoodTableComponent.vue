<template>
  <div>
    <div v-if="imperativeMood">
      <h4 class="text-center">Повелительное наклонение</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th>Единственное число</th>
          <th>Множественное число</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td :class="{ equals: equalsWithWord(imperativeMood['ЕД']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(imperativeMood['ЕД']['Слово'].toLowerCase()) &&
                         (!imperativeMood['Жесты']['ЕД'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWordForm"
                         :value="JSON.stringify(imperativeMood['ЕД'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ imperativeMood['ЕД']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(imperativeMood['МН']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(imperativeMood['МН']['Слово'].toLowerCase()) &&
                         (!imperativeMood['Жесты']['МН'] || !selectJests)"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :data-base-word-form="baseWordForm"
                         :value="JSON.stringify(imperativeMood['МН'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ imperativeMood['МН']['Слово'].toLowerCase() }}
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
  name: "ImperativeMoodTableComponent",
  props: {
    imperativeMood: {
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
