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
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['МР']['НОРМ']) }">
            {{
              partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['МР']['НОРМ'].toLowerCase()
            }}
          </td>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['ЖР']['НОРМ']) }">
            {{
              partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['ЖР']['НОРМ'].toLowerCase()
            }}
          </td>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['СР']['НОРМ']) }">
            {{
              partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['ЕД']['СР']['НОРМ'].toLowerCase()
            }}
          </td>
          <td
            :class="{ equals: equalsWithWord(partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['МН']['НОРМ']) }">
            {{ partOfSpeech[baseWord]['Падежи'][partOfSpeechCase]['МН']['НОРМ'].toLowerCase() }}
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

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
  mixins: [GrammemsService]
}
</script>

<style scoped>

</style>
