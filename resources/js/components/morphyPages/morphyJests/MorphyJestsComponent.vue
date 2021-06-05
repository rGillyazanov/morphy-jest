<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-2">
          <label for="words">Слова</label>
          <input id="words" class="form-control" type="text"
                 @change="getAllWords"
                 v-model="searchWord"
                 :disabled="shareLoading"
                 placeholder="Поиск слова">
          <select class="mt-3 custom-select" size="10" :disabled="shareLoading">
            <option @click="wordSelected(wordForm, wordForm.id_word)" :value="wordForm"
                    v-for="wordForm in wordForms.words">{{ wordForm.word }}
            </option>
          </select>
        </div>
        <div class="col-2" :class="{'disabled-block': shareLoading}">
          <template v-if="wordForms.selected.jests.length > 0">
            <span>Жесты в слове:</span>
            <template v-for="jest in paginatedData">
              <div class="d-flex flex-column">
                <span class="font-weight-bold" :class="{'equals': currentJestId === jest.id_jest}">{{ jest.jest }} {{ jest.nedooformleno ? '*' : '' }}</span>
                <img
                  @click="selectJest(jest.id_jest)"
                  :src="`https://slovar.jest.su/storage/media/small_img/${jest.id_jest}.jpg`"
                  width="200"
                  class="img-fluid my-1 cursor-pointer"
                  alt="">
              </div>
            </template>
            <div class="d-flex align-items-center">
              <button
                class="btn btn-default"
                :disabled="pageNumber === 0"
                @click="prevPage">
                Назад
              </button>
              <template v-if="pageNumber * size + size > wordForms.selected.jests.length">
                {{ wordForms.selected.jests.length }} из {{ wordForms.selected.jests.length }}
              </template>
              <template v-else>
                {{ pageNumber * size + 1 }} - {{ (pageNumber * size + size) }} из {{ wordForms.selected.jests.length }}
              </template>
              <button
                class="btn btn-default"
                :disabled="pageNumber >= pageCount -1"
                @click="nextPage">
                Вперед
              </button>
            </div>
          </template>
        </div>
        <div class="col-2">
          <template v-if="wordsInJest.words.length">
            <label for="wordsOnJest">Слова в жесте</label>
            <select id="wordsOnJest" class="custom-select" size="14" :disabled="shareLoading">
              <option
                class="cursor-pointer"
                @click="selectWordForm(wordInJest)"
                :value="wordInJest"
                v-for="wordInJest in wordsInJest.words">
                {{ wordInJest.word }}
              </option>
            </select>
          </template>
          <div class="d-flex justify-content-center" v-else-if="wordsInJest.loading">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
        <div class="col-6" v-if="word">
          <div v-if="!wordFormsOfWord.loading">
            <div v-if="wordFormsOfWord.error.value">
              {{ response.error.message }}
            </div>
            <div v-else-if="wordFormsOfWord.data">
              <part-of-speech-table
                :active-word-forms="activeWordFormsInJest"
                :word="word"
                @selected-words="selectedWords = $event"
                :scrollable="true"
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
import PartOfSpeechTable from "./partOfSpeechWord/PartOfSpeechTable";
import {getAllWords, loadingWordFormsOfWord} from "../../../services/apiService";

export default {
  name: 'MorphyJestsComponent',
  components: {PartOfSpeechTable},
  data() {
    return {
      word: '',
      searchWord: '',
      currentJestId: null,
      wordForms: {
        words: [],
        selected: {
          id: null,
          word: null,
          jests: []
        },
        loading: false
      },
      wordsInJest: {
        loading: false,
        words: [],
        selectedWord: {}
      },
      activeWordFormsInJest: [],
      loadingActiveWordFormsInJest: false,
      wordFormsOfWord: {
        data: null,
        error: {
          value: false,
          message: ''
        },
        loading: false
      },
      savingWordForms: false,
      pageNumber: 0,
      size: 4,
      saveResponse: {
        loading: false,
        message: ''
      },
      selectedWords: []
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
    wordSelected(selectedWord, wordId) {
      if (this.wordForms.selected.id !== wordId) {
        this.wordForms.selected.jests = [];
        this.word = null;
        this.activeWordFormsInJest = null;
        this.wordsInJest.words = [];
        this.wordForms.selected.id = wordId;
        this.currentJestId = null;
        this.wordsInJest.selectedWord = null;

        this.wordForms.loading = true;
        axios.get('/api/jestsOfWord/' + wordId).then(response => {
          this.wordForms.selected.jests = response.data

          this.wordForms.loading = false;
        });
      }
    },
    selectJest(jestId) {
      if (this.currentJestId !== jestId) {
        this.word = null;
        this.activeWordFormsInJest = null;
        this.wordsInJest.words = [];
        this.currentJestId = jestId;

        this.wordsInJest.selectedWord = null;

        this.wordsInJest.loading = true;

        axios.get('/api/allWordsOfJest/' + jestId).then(response => {
          const regEx = /^[а-яА-ЯёЁ]+$/u;
          this.wordsInJest.words = response.data[0].words?.filter(word => regEx.test(word.word) === true);
          this.wordsInJest.loading = false;
        }).catch(error => {
          console.error(error);
          this.wordsInJest.loading = false;
        });
      }
    },
    selectWordForm(selectedWordForm) {
      if (this.word !== selectedWordForm.word && !this.loadingActiveWordFormsInJest) {
        this.word = selectedWordForm.word;
        this.wordsInJest.selectedWord = selectedWordForm;

        this.loadingActiveWordFormsInJest = true;
        axios.get('/api/getWordFormsInJest/' + this.currentJestId + '/word/' + this.wordsInJest.selectedWord.id_word).then(response => {
          this.activeWordFormsInJest = response.data?.map(word => {
            return JSON.stringify(word);
          });

          this.loadingActiveWordFormsInJest = false;
        });
      }
    },
    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },
    async getAllWords() {
      this.wordForms.words = await getAllWords(this.searchWord);
    },
    save() {
      this.saveResponse.loading = true;

      axios.post('/api/storeWordFormsInJest', {
        jest_id: this.currentJestId,
        word_id: this.wordsInJest.selectedWord.id_word,
        wordForms: JSON.stringify(this.selectedWords)
      }).then(response => {
        this.saveResponse.loading = false;
        if (response.status === 200) {
          this.saveResponse.message = 'Словоформы успешно сохранены';

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
  },
  computed: {
    pageCount() {
      let l = this.wordForms.selected.jests.length,
        s = this.size;
      return Math.ceil(l / s);
    },
    paginatedData() {
      const start = this.pageNumber * this.size, end = start + this.size;

      return this.wordForms.selected.jests.slice(start, end);
    },
    shareLoading() {
      return this.wordForms.loading || this.wordFormsOfWord.loading || this.wordsInJest.loading || this.savingWordForms;
    }
  }
}
</script>

<style lang="scss">
.cursor-pointer {
  cursor: pointer;
}

.disabled-block {
  pointer-events: none;
  opacity: 0.4;
}
</style>
