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
          <td :class="{ equals: equalsWithWord(adverbParticiple['Настоящее']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(adverbParticiple['Настоящее']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adverbParticiple['Настоящее'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ adverbParticiple['Настоящее']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(adverbParticiple['Прошедшее']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(adverbParticiple['Прошедшее']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adverbParticiple['Прошедшее'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ adverbParticiple['Прошедшее']['Слово'].toLowerCase() }}
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
  mixins: [GrammemsMixin, SelectedWordsMixin]
}
</script>

<style scoped>

</style>
