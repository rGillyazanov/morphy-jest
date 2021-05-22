<template>
  <div>
    <hr>
    <div v-for="baseWord in Object.keys(partOfSpeech)">
      <div class="py-3"><b>Базовая форма</b>: {{ baseWord }} - {{
          listOfGrammems(partOfSpeech[baseWord]['Граммемы'])
        }}
      </div>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th rowspan="2">&nbsp;</th>
          <th colspan="3" class="text-center">Единственное число</th>
          <th rowspan="2" class="align-middle">Множественное число</th>
        </tr>
        <tr>
          <th>Мужской род</th>
          <th>Женский род</th>
          <th>Средний род</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="partOfSpeechCase in Object.keys(partOfSpeech[baseWord]['Падежи'])">
          <th>{{ partOfSpeechCase }}</th>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['МР']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['МР']['НОРМ']['Слово'].toLowerCase())"
                   class="form-check form-check-inline pr-2">
                <input class="form-check-input"
                       type="checkbox"
                       :value="JSON.stringify(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['МР']['НОРМ'])"
                       v-model="selectedWords">
              </div>
              {{
                partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['МР']['НОРМ']['Слово'].toLowerCase()
              }}
            </div>
          </td>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase())"
                   class="form-check form-check-inline pr-2">
                <input class="form-check-input"
                       type="checkbox"
                       :value="JSON.stringify(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['ЖР']['НОРМ'])"
                       v-model="selectedWords">
              </div>
              {{
                partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase()
              }}
            </div>
          </td>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['СР']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['СР']['НОРМ']['Слово'].toLowerCase())"
                   class="form-check form-check-inline pr-2">
                <input class="form-check-input"
                       type="checkbox"
                       :value="JSON.stringify(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['СР']['НОРМ'])"
                       v-model="selectedWords">
              </div>
              {{
                partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['СР']['НОРМ']['Слово'].toLowerCase()
              }}
            </div>
          </td>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['МН']['НОРМ']['Слово']) }">
            <div class="d-flex align-items-center">
              <div v-if="!isEmptyWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['МН']['НОРМ']['Слово'].toLowerCase())"
                   class="form-check form-check-inline pr-2">
                <input class="form-check-input"
                       type="checkbox"
                       :value="JSON.stringify(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['МН']['НОРМ'])"
                       v-model="selectedWords">
              </div>
              {{ partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['МН']['НОРМ']['Слово'].toLowerCase() }}
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
  name: "BaseCasesFacesTableComponent",
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
  mixins: [GrammemsMixin, SelectedWordsMixin],
}
</script>

<style scoped>

</style>
