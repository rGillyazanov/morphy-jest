<template>
  <div>
    <template v-if="!loadingStatistics">
      <div class="row">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="Введите словоформу для поиска"
                 v-model="searchingWordForm">

          <label for="intersectionWordForms" class="mt-2">Список пересечённых словоформ -
            <span data-toggle="tooltip" data-placement="top" title="Количество словоформ">({{ countOfWordFormsInReport }})</span>:</label>
          <select id="intersectionWordForms" class="custom-select" size="10">
            <option @click="selectedWordForm = wordForm;" :value="wordForm"
                    v-for="wordForm in searchFilter">
              {{ wordForm }}
            </option>
          </select>

          <div class="custom-control custom-checkbox mt-2">
            <input type="checkbox"
                   v-model="twoAndMoreWordForms"
                   class="custom-control-input"
                   id="twoAndMoreWordForms">
            <label class="custom-control-label" for="twoAndMoreWordForms">2 и более базовых форм</label>
          </div>
        </div>
        <div class="col-9">
          <template v-if="selectedWordForm">
            <div class="h2 mb-3">Словоформа: <b>{{ upperFirst(selectedWordForm.toLowerCase()) }}</b></div>

            <template v-for="(baseWordForm, index) in Object.keys(report[selectedWordForm])">
              <span class="h5">{{ index + 1 }}. <b>Базовая форма:</b> <span class="equals">{{ upperFirst(baseWordForm) }}</span></span>
              <div class="row my-3">
                <div class="col-6 mb-2" v-for="word in report[selectedWordForm][baseWordForm]">
                  <div class="border p-3">
                    <div>
                      <span class="text-word-forms-navigation">Словоформа:</span>
                      {{ word['Слово'] }}
                    </div>
                    <ol class="mb-0">
                      <li v-for="(grammem, index) in listOfGrammemsSort(word['Граммемы'])" :key="index">
                        {{ upperFirst(grammem) }}
                      </li>
                    </ol>
                    <div>
                      <span class="text-word-forms-navigation">Часть речи:</span>
                      {{ descriptorToPartOfSpeech(word['Часть речи']) }}
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
  name: "MorphyIntersectionsWordFormsComponent",
  mixins: [GrammemsMixin],
  data() {
    return {
      loadingStatistics: true,
      selectedWordForm: null,
      searchingWordForm: '',
      report: {},
      countOfWordFormsInReport: 0,
      twoAndMoreWordForms: false
    }
  },
  computed: {
    searchFilter() {
      if (!_.isEmpty(this.report)) {
        const keys = Object.keys(this.report).sort();

        const filter = (key, twoAndMore) => {
          if (twoAndMore) {
            return key.includes(this.searchingWordForm.toUpperCase()) && Object.keys(this.report[key]).length >= 2;
          }
          return key.includes(this.searchingWordForm.toUpperCase());
        };

        return this.searchingWordForm || this.twoAndMoreWordForms ?
          keys.filter(key => filter(key, this.twoAndMoreWordForms)) : keys;
      }
    }
  },
  watch: {
    searchFilter() {
      this.countOfWordFormsInReport = this.searchFilter.length;
    }
  },
  methods: {
    listOfGrammemsSort(grammems) {
      return this.listOfGrammems(grammems, true).sort();
    },
    upperFirst(str) {
      return _.upperFirst(str)
    }
  },
  mounted() {
    this.loadingStatistics = true;
    axios.get('/api/intersections').then(response => {
      this.report = _.groupBy(response.data, 'Слово');

      Object.keys(this.report).forEach(key => {
        this.report[key] = _.groupBy(this.report[key], 'Базовая форма');
      });

      this.countOfWordFormsInReport = Object.keys(this.report).length;

      this.loadingStatistics = false;

      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });
    });
  }
}
</script>

<style scoped>
  .text-word-forms-navigation {
    font-weight: 600;
  }
</style>
