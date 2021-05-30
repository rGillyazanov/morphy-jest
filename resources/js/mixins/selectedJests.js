export const SelectedWordsMixin = {
  data() {
    return {
      selectedWords: this.activeWordForms
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
