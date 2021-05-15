<template>
  <div>
    <div v-if="partOfSpeech" v-for="partOfSpeechTime in Object.keys(partOfSpeech)">

      <div v-for="partOfSpeechVoice in Object.keys(partOfSpeech[partOfSpeechTime])" v-if="partOfSpeech[partOfSpeechTime][partOfSpeechVoice]">
        <h4 class="text-center">Причастие - {{ partOfSpeechTime.toLowerCase() }}, {{ partOfSpeechVoice.toLowerCase() }}</h4>
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
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['МР']['НОРМ']) }">
              {{ partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['МР']['НОРМ'].toLowerCase() }}
            </td>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']) }">
              {{ partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['ЖР']['НОРМ'].toLowerCase() }}
            </td>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['СР']['НОРМ']) }">
              {{ partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['ЕД']['СР']['НОРМ'].toLowerCase() }}
            </td>
            <td
              :class="{ equals: equalsWithWord(partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['МН']['НОРМ']) }">
              {{ partOfSpeech[partOfSpeechTime][partOfSpeechVoice][partOfSpeechCase]['МН']['НОРМ'].toLowerCase() }}
            </td>
          </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

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
  mixins: [GrammemsService]
}
</script>

<style scoped>

</style>
