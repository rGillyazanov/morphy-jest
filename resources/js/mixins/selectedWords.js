import {objectEquals, onlyUnique} from "../services/heplService";

export const SelectedWordsMixin = {
  data() {
    return {
      selectedWords: []
    }
  },
  watch: {
    selectedWords: {
      deep: true,
      handler() {
        this.$emit('selected-words', this.selectedWords);
      }
    }
  }
}

export function uniqueWords() {
  let allWords = [];

  Object.keys(this.selectedWords).forEach(key => {
    if (key !== 'all') {
      allWords = allWords.concat(this.selectedWords[key]);
    }
  });

  return allWords.filter(onlyUnique);
}
