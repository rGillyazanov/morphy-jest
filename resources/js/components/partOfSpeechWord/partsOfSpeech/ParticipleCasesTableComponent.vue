<template>
  <div>
    <div v-if="partOfSpeech" v-for="partOfSpeechTime in Object.keys(partOfSpeech)">

      <div v-for="partOfSpeechVoice in Object.keys(partOfSpeech[partOfSpeechTime])"
           v-if="partOfSpeech[partOfSpeechTime][partOfSpeechVoice]">
        <h4 class="text-center">Причастие - {{ partOfSpeechTime.toLowerCase() }}, {{
            partOfSpeechVoice.toLowerCase()
          }}</h4>
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
          <tr v-for="partOfSpeechCase in Object.keys(partOfSpeech[partOfSpeechTime][partOfSpeechVoice])">
            <th>{{ partOfSpeechCase }}</th>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['МР']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                {{
                  partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['МР']['НОРМ']['Слово'].toLowerCase()
                }}
                <div
                  v-if="!isEmptyWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['МР']['НОРМ']['Слово'].toLowerCase())"
                  class="d-inline-flex pl-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           :value="JSON.stringify(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['МР']['НОРМ'])"
                           v-model="selectedWords">
                  </div>
                </div>
              </div>
            </td>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                {{
                  partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase()
                }}
                <div
                  v-if="!isEmptyWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase())"
                  class="d-inline-flex pl-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           :value="JSON.stringify(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['ЖР']['НОРМ'])"
                           v-model="selectedWords">
                  </div>
                </div>
              </div>
            </td>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['СР']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                {{
                  partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['СР']['НОРМ']['Слово'].toLowerCase()
                }}
                <div
                  v-if="!isEmptyWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['СР']['НОРМ']['Слово'].toLowerCase())"
                  class="d-inline-flex pl-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           :value="JSON.stringify(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['СР']['НОРМ'])"
                           v-model="selectedWords">
                  </div>
                </div>
              </div>
            </td>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['МН']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                {{ partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['МН']['НОРМ']['Слово'].toLowerCase() }}
                <div
                  v-if="!isEmptyWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['МН']['НОРМ']['Слово'].toLowerCase())"
                  class="d-inline-flex pl-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           :value="JSON.stringify(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['МН']['НОРМ']['Слово'])"
                           v-model="selectedWords">
                  </div>
                </div>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</template>

<script>
import {GrammemsMixin} from "../../../mixins/grammems";
import {SelectedWordsMixin} from "../../../mixins/selectedWords";

export default {
  name: "ParticipleCasesTableComponent",
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
  mixins: [GrammemsMixin, SelectedWordsMixin]
}
</script>

<style scoped>

</style>
