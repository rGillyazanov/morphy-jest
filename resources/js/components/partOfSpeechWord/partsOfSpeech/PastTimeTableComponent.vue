<template>
  <div>
    <div v-if="pastTime">
      <h4 class="text-center">Прошедшее время</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th colspan="3">Единственное число</th>
          <th rowspan="2" class="text-center align-middle">Множественное число</th>
        </tr>
        <tr>
          <th>мужской</th>
          <th>женский</th>
          <th>средний</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td :class="{ equals: equalsWithWord(pastTime['ЕД']['МР']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(pastTime['ЕД']['МР']['НОРМ']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(pastTime['ЕД']['МР']['НОРМ'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ pastTime['ЕД']['МР']['НОРМ']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(pastTime['ЕД']['ЖР']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(pastTime['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(pastTime['ЕД']['ЖР']['НОРМ'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ pastTime['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(pastTime['ЕД']['СР']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(pastTime['ЕД']['СР']['НОРМ']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(pastTime['ЕД']['СР']['НОРМ'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{ pastTime['ЕД']['СР']['НОРМ']['Слово'].toLowerCase() }}
            </div>
          </td>
          <td :class="{ equals: equalsWithWord(pastTime['МН']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(pastTime['МН']['НОРМ']['Слово'].toLowerCase())"
                   class="d-inline-flex pr-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(pastTime['МН']['НОРМ'])"
                         v-model="selectedWords">
                </div>
              </div>
              {{
                pastTime['МН']['НОРМ']['Слово'].toLowerCase()
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
import {GrammemsMixin} from "../../../mixins/grammems";
import {SelectedWordsMixin} from "../../../mixins/selectedWords";

export default {
  name: "PastTimeTableComponent",
  props: {
    pastTime: {
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
