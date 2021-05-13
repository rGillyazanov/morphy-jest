<template>
  <div class="card">
    <div class="card-body">
      <input
        type="text"
        v-model="word"
        @change="loadWord"
        placeholder="Введите слово">

      <div v-if="!response.loading">
        <div v-if="response.error.value">
          {{ response.error.message }}
        </div>
        <div v-else-if="response.data">
          <part-of-speech-table
            :word="word"
            :parts-of-speech-word="response.data">
          </part-of-speech-table>
        </div>
      </div>
      <div v-else>Loading...</div>
    </div>
  </div>
</template>

<script>
import PartOfSpeechTable from "./partOfSpeechWord/PartOfSpeechTable";

export default {
  components: {PartOfSpeechTable},
  data() {
    return {
      word: '',
      response: {
        data: null,
        error: {
          value: false,
          message: ''
        },
        loading: false
      }
    }
  },
  methods: {
    loadWord() {
      if (this.word) {
        this.response.loading = true;
        axios.get('/api/testAnal/' + this.word).then(response => {
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
    }
  }
}
</script>
