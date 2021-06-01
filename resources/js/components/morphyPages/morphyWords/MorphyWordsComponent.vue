<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-2">
          <label for="words">Слова</label>
          <input id="words" class="form-control" type="text"
                 @change="getAllWords"
                 v-model="searchWord"
                 placeholder="Поиск слова">
          <select class="mt-3 custom-select" size="10" :disabled="wordFormsOfWord.loading">
            <option @click="selectWord(wordForm)" :value="wordForm"
                    v-for="wordForm in wordForms.words">
              {{ wordForm.word }}
            </option>
          </select>
        </div>
        <div class="col-10" v-if="word">
          <div v-if="!wordFormsOfWord.loading">
            <div v-if="wordFormsOfWord.error.value">
              {{ response.error.message }}
            </div>
            <div v-else-if="wordFormsOfWord.data">
              <part-of-speech-table
                :active-word-forms="activeWordForms"
                :selected-jests="activeWordFormsInJest"
                :word="word"
                :select-jests="true"
                @selected-jests="selectedJests = $event"
                :parts-of-speech-word="wordFormsOfWord.data">
              </part-of-speech-table>

              <div class="d-flex align-items-center mt-2">
                <button class="btn btn-primary" type="button" @click="save" :disabled="saveResponse.loading">
                  <template v-if="saveResponse.loading">
                    <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                    Сохранение...
                  </template>
                  <template v-else>Сохранить</template>
                </button>
                <div class="ml-3"
                     v-if="saveResponse.message">
                  {{ saveResponse.message }}
                </div>
              </div>
            </div>
          </div>
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
      </div>
    </div>
  </div>
</template>

<script>
import {getAllWords, loadingWordFormsOfWord} from "../../../services/apiService";
import PartOfSpeechTable from "../morphyJests/partOfSpeechWord/PartOfSpeechTable";

export default {
  name: "MorphyWordsComponent",
  components: {PartOfSpeechTable},
  data() {
    return {
      word: '',
      searchWord: '',
      wordForms: {
        words: [],
        selected: null,
        loading: false
      },
      activeWordForms: [],
      activeWordFormsInJest: {},
      loadingActiveWordFormsInJest: false,
      wordFormsOfWord: {
        data: null,
        error: {
          value: false,
          message: ''
        },
        loading: false
      },
      saveResponse: {
        loading: false,
        message: ''
      },
      selectedJests: null,
      savingWordForms: false,
    }
  },
  watch: {
    word() {
      this.loadWord();
    },
  },
  methods: {
    async loadWord() {
      if (this.word) {
        this.wordFormsOfWord.loading = true;

        const words = await loadingWordFormsOfWord(this.word);

        if (words) {
          this.wordFormsOfWord.data = words;
          this.wordFormsOfWord.error.value = false;
        } else {
          this.wordFormsOfWord.data = null;
          this.wordFormsOfWord.error.value = true;
          this.wordFormsOfWord.error.message = 'Слово не найдено';
        }

        this.wordFormsOfWord.loading = false;
      }
    },
    selectWord(selectedWord) {
      if (this.word !== selectedWord.word && !this.loadingActiveWordFormsInJest) {
        this.word = selectedWord.word;
        this.wordForms.selected = selectedWord;

        this.loadingActiveWordFormsInJest = true;
        axios.get('/api/wordFormJestsInWord/' + this.wordForms.selected.id_word).then(response => {
          Object.keys(response.data).forEach(key => {
            response.data[key].forEach((item, index) => {
              response.data[key][index]['jest'] = Object.assign({}, response.data[key][index]['jest']);
            });
          });

          this.activeWordFormsInJest = !_.isEmpty(response.data) ? response.data : {};
          this.activeWordForms = Object.keys(response.data);

          this.loadingActiveWordFormsInJest = false;
        });
      }
    },
    async getAllWords() {
      this.wordForms.words = await getAllWords(this.searchWord);
    },
    save() {
      this.saveResponse.loading = true;

      axios.post('/api/storeJestsWordForm', {
        word_id: this.wordForms.selected.id_word,
        wordFormsWithJests: JSON.stringify(this.selectedJests)
      }).then(response => {
        this.saveResponse.loading = false;
        if (response.status === 200) {
          this.saveResponse.message = 'Сохранение завершено';

          setTimeout(() => {
            this.saveResponse.message = '';
          }, 5000);
        }
      }).catch(error => {
        this.saveResponse.loading = false;
        this.saveResponse.message = error;
      });
    }
  },
  mounted() {
    this.getAllWords();
  }
}
</script>

<style scoped>

</style>
