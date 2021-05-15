<template>
  <div>

    <div v-for="adjective in Object.keys(adjectives)">
      <div class="py-3"><b>Базовая форма</b>: <span class="equals">{{ adjective }}</span> - {{
          listOfGrammems(adjectives[adjective]['Граммемы'])
        }}
      </div>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th colspan="2" rowspan="2">&nbsp;</th>
          <th colspan="3" class="text-center">Единственное число</th>
          <th rowspan="2" class="text-center align-middle">Множественное число</th>
        </tr>
        <tr>
          <th class="mr">Мужской род</th>
          <th class="jr">Женский род</th>
          <th class="sr">Средний род</th>
        </tr>
        </thead>
        <tbody>
        <template v-for="adjectiveCase in adjectiveCases(adjective)">
          <tr>
            <th class="align-middle"
                :rowspan="!isShortAdjective(adjectiveCase) ? 2 : 1"
                :colspan="!isShortAdjective(adjectiveCase) ? 1 : 2">
              {{ adjectiveCase }}
            </th>
            <th
              v-if="!isShortAdjective(adjectiveCase)"
              class="small">
              норм.
            </th>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['НОРМ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['НОРМ'].toLowerCase() }}
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['НОРМ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['НОРМ'].toLowerCase() }}
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['НОРМ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['НОРМ'].toLowerCase() }}
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['НОРМ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['МН']['НОРМ'].toLowerCase() }}
            </td>
          </tr>
          <tr v-if="!isShortAdjective(adjectiveCase)">
            <th class="small">прев.</th>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['ПРЕВ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['ПРЕВ'].toLowerCase() }}
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['ПРЕВ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['ПРЕВ'].toLowerCase() }}
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['ПРЕВ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['ПРЕВ'].toLowerCase() }}
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['ПРЕВ']) }">
              {{ adjectives[adjective]['Падежи'][adjectiveCase]['МН']['ПРЕВ'].toLowerCase() }}
            </td>
          </tr>
        </template>
        <tr>
          <th colspan="2">Сравнительная степень</th>
          <td colspan="4">{{ adjectives[adjective]['Падежи']['Сравнительная степень'].join(', ').toLowerCase() }}</td>
        </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "AdjectiveCasesTableComponent",
  props: {
    adjectives: {
      type: Object,
      required: true
    },
    word: {
      type: String,
      required: true
    }
  },
  mixins: [GrammemsService],
  methods: {
    adjectiveCases(adjective) {
      return Object.keys(this.adjectives[adjective]['Падежи']).filter(key => key !== 'Сравнительная степень');
    },
    isShortAdjective(adjectiveCase) {
      return adjectiveCase === 'Краткое прилагательное';
    }
  }
}
</script>

<style scoped>

</style>
