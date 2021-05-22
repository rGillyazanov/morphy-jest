<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-2">
          <label for="words">Слова</label>
          <input id="words" class="form-control" type="text" placeholder="Поиск слова">
          <select class="mt-3 custom-select" size="10">
            <option @click="wordSelected(wordForm, wordForm.id_word)" :value="wordForm"
                    v-for="wordForm in wordForms.words">{{ wordForm.word }}
            </option>
          </select>
        </div>
        <div class="col-2">
          <template v-if="wordForms.selected.jests.length > 0">
            <template v-for="jest in paginatedData">
              <div class="d-flex flex-column">
                <span class="font-weight-bold">{{ jest.jest }} {{ jest.nedooformleno ? '*' : '' }}</span>
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
          <label for="wordsOnJest">Слова в жесте</label>
          <select id="wordsOnJest" class="custom-select" size="14">
            <option @click="word = wordInJest.word" :value="wordInJest" v-for="wordInJest in wordsInJest.words">
              {{ wordInJest.word }}
            </option>
          </select>
        </div>
        <div class="col-6" v-if="word">
          <div v-if="!response.loading">
            <div v-if="response.error.value">
              {{ response.error.message }}
            </div>
            <div v-else-if="response.data">
              <part-of-speech-table
                :jest-id="currentJestId"
                :word="word"
                :parts-of-speech-word="response.data">
              </part-of-speech-table>
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

export default {
  name: 'MorphyWordComponent',
  components: {PartOfSpeechTable},
  data() {
    return {
      word: '',
      wordForms: {
        words: [],
        selected: {
          id: null,
          word: null,
          jests: []
        }
      },
      wordsInJest: {
        words: []
      },
      currentJestId: null,
      response: {
        data: null,
        error: {
          value: false,
          message: ''
        },
        loading: false
      },
      pageNumber: 0,
      size: 4
    }
  },
  watch: {
    word() {
      this.loadWord();
    }
  },
  methods: {
    loadWord() {
      if (this.word) {
        this.response.loading = true;
        axios.get('/api/words/' + this.word).then(response => {
          this.response.data = response.data[0];
          this.response.error.value = false;
          this.response.loading = false;
        }).catch(error => {
          this.response.data = null;
          this.response.error.value = true;
          this.response.error.message = 'Слово не найдено';
          this.response.loading = false;
        })
      }
    },
    wordSelected(selectedWord, wordId) {
      this.wordForms.selected.jests = [];
      this.word = null;
      this.wordsInJest.words = [];
      this.wordForms.selected.id = wordId;

      axios.get('/api/jestsOfWord/' + wordId).then(response => {
        this.wordForms.selected.jests = response.data
      });
    },
    selectJest(jestId) {
      this.currentJestId = jestId;
      axios.get('/api/allWordsOfJest/' + jestId).then(response => {
        const regEx = /^[а-яА-ЯёЁ]+$/u;
        this.wordsInJest.words = response.data[0].words?.filter(word => regEx.test(word.word) === true);
      });
    },
    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    }
  },
  mounted() {
    axios.get('/api/allWords').then(response => {
      const regEx = /^[а-яА-ЯёЁ]+$/u;
      this.wordForms.words = response.data.filter(word => regEx.test(word.word) === true);
    })
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
    }
  }
}
</script>

<style lang="scss">
.cursor-pointer {
  cursor: pointer;
}
</style>
