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
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['НОРМ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['НОРМ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['НОРМ']['Слово'].toLowerCase() }}
              </div>
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['НОРМ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['НОРМ']['Слово'].toLowerCase() }}
              </div>
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['НОРМ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['НОРМ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['НОРМ']['Слово'].toLowerCase() }}
              </div>
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['НОРМ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['НОРМ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['НОРМ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['МН']['НОРМ']['Слово'].toLowerCase() }}
              </div>
            </td>
          </tr>
          <tr v-if="!isShortAdjective(adjectiveCase)">
            <th class="small">прев.</th>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['ПРЕВ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['ПРЕВ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['ПРЕВ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['МР']['ПРЕВ']['Слово'].toLowerCase() }}
              </div>
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['ПРЕВ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['ПРЕВ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['ПРЕВ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['ЖР']['ПРЕВ']['Слово'].toLowerCase() }}
              </div>
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['ПРЕВ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['ПРЕВ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['ПРЕВ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['ЕД']['СР']['ПРЕВ']['Слово'].toLowerCase() }}
              </div>
            </td>
            <td :class="{ equals: equalsWithWord(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['ПРЕВ']['Слово']) }">
              <div class="d-flex align-items-center">
                <div v-if="!isEmptyWord(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['ПРЕВ']['Слово'].toLowerCase())"
                     class="form-check form-check-inline pr-2">
                  <input class="form-check-input"
                         type="checkbox"
                         :value="JSON.stringify(adjectives[adjective]['Падежи'][adjectiveCase]['МН']['ПРЕВ'])"
                         v-model="selectedWords">
                </div>
                {{ adjectives[adjective]['Падежи'][adjectiveCase]['МН']['ПРЕВ']['Слово'].toLowerCase() }}
              </div>
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
import {GrammemsMixin} from "../../../mixins/grammems";
import {SelectedWordsMixin} from "../../../mixins/selectedWords";

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
  mixins: [GrammemsMixin, SelectedWordsMixin],
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
