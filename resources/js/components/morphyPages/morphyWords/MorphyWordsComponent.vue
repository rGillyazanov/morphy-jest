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
          <select class="mt-3 custom-select" size="10">
            <option @click="word = wordForm.word" :value="wordForm"
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
                :active-word-forms="activeWordFormsInJest"
                :word="word"
                :select-jests="true"
                @selected-words="selectedWords = $event"
                :parts-of-speech-word="wordFormsOfWord.data">
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
        selected: {
          id: null,
          word: null
        },
        loading: false
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
      if (this.word !== selectedWord && !this.loadingActiveWordFormsInJest) {
        this.word = selectedWord;

        this.loadingActiveWordFormsInJest = true;
        axios.get('/api/getWordFormsInJest/' + this.currentJestId).then(response => {
          this.activeWordFormsInJest = response.data?.map(word => {
            return JSON.stringify(word);
          });

          this.loadingActiveWordFormsInJest = false;
        });
      }
    },
    async getAllWords() {
      this.wordForms.words = await getAllWords(this.searchWord);
    }
  },
  mounted() {
    this.getAllWords();
  }
}
</script>

<style scoped>

</style>
