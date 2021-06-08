<template>
  <div>
    <template v-if="!loadingStatistics">
      <h1>Статистика</h1>
      <ol>
        <li>Сколько жестов обработано: {{ statistics.countJests }}</li>
        <li>Сколько слов обработано: {{ statistics.countWords }}</li>
        <li>Сколько словоформ сгенерировано: {{ statistics.countWordForms }}</li>
        <li>Сколько словоформ связано: {{ statistics.countSvyaz }}</li>
        <li>Сколько словоформ несвязано: {{ statistics.countNotSvyaz }}</li>
        <li>Сколько словоформ имеют единичную связь с жестом.</li>
        <li>Сколько словоформ имеют единичную связь с несколькими жестами.</li>
        <li>Сколько словоформ имеют единичную связь с несколькими жестами.</li>
      </ol>

      <h3>Количество пересечённых словоформ: {{ countOfWordFormsInReport }}</h3>

      <div class="row">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="Введите словоформу для поиска"
                 v-model="searchingWordForm"
                 @change="searchWordForm()">
          <select class="mt-3 custom-select" size="10">
            <option @click="selectWord(wordForm)" :value="wordForm"
                    v-for="wordForm in searchFilter">
              {{ wordForm }}
            </option>
          </select>
        </div>
        <div class="col-9">
          <template v-if="selectedWordForm">
            <div class="h2 mb-3">Информация о пересечении словоформы <b>{{ selectedWordForm.toLowerCase() }}</b></div>

            <template v-for="(baseWordForm, index) in Object.keys(report[selectedWordForm])">
              <span class="h3">{{ index + 1}}. <b>Базовая форма:</b> <span class="equals">{{ baseWordForm }}</span><br></span>
              <div class="row my-3">
                <div class="col-12">
                  <div class="row">
                    <div class="col-6 mb-2" v-for="word in report[selectedWordForm][baseWordForm]">
                      <div class="border p-3">
                        <span class="text-word-forms-navigation">Слово</span>: {{ word['Слово'] }}<br>
                        <span class="text-word-forms-navigation">Граммемы</span>: {{ listOfGrammems(word['Граммемы']) }}<br>
                        <span class="text-word-forms-navigation">Часть речи</span>: {{ descriptorToPartOfSpeech(word['Часть речи']) }}<br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </template>
        </div>
      </div>
    </template>
    <div v-else>
      <div class="row">
        <div class="col-12 mt-4">
          <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {GrammemsMixin} from "../../../mixins/grammems";

export default {
  name: "MorphyStatistics",
  mixins: [GrammemsMixin],
  data() {
    return {
      statistics: {
        countJests: 0,
        countWords: 0,
        countWordForms: 0,
        countSvyaz: 0,
        countNotSvyaz: 0,
      },
      loadingStatistics: true,
      selectedWordForm: null,
      searchingWordForm: '',
      report: {},
      countOfWordFormsInReport: 0,
    }
  },
  methods: {
    selectWord(word) {
      this.selectedWordForm = word;
    },
    searchWordForm() {
      console.log(this.searchingWordForm);
    }
  },
  computed: {
    searchFilter() {
      const keys = Object.keys(this.report).sort();
      return this.searchingWordForm ?
        keys.filter(key => key.includes(this.searchingWordForm.toUpperCase())) : keys;
    }
  },
  mounted() {
    this.loadingStatistics = true;
    axios.get('/api/statistics').then(response => {
      this.statistics.countJests = response.data['жестов обработано'];
      this.statistics.countWords = response.data['слов обработано'];
      this.statistics.countWordForms = response.data['словоформ сгенерировано'];
      this.statistics.countSvyaz = response.data['словоформ связано'];
      this.statistics.countNotSvyaz = response.data['словоформ несвязано'];
      this.report = _.groupBy(response.data['пересечение словоформ'], 'Слово');

      Object.keys(this.report).forEach(key => {
        this.report[key] = _.groupBy(this.report[key], 'Базовая форма');
      });

      this.countOfWordFormsInReport = Object.keys(this.report).length;

      this.loadingStatistics = false;
    });
  }
}
</script>

<style scoped lang="scss">
  .text-word-forms-navigation {
    font-weight: 600;
  }
</style>
