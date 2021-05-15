<template>
  <div>
    <hr>
    <div v-for="baseWord in Object.keys(partOfSpeech)">
      <div class="py-3"><b>Базовая форма</b>: <span class="equals">{{ baseWord }}</span> - {{
          listOfGrammems(partOfSpeech[baseWord]['Граммемы'])
        }}, неизменяемое слово.
      </div>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
name: "UnchangeableWordComponent",
  props: {
    partOfSpeech: {
      type: Object,
      required: true
    },
    word: {
      type: String,
      required: true
    }
  },
  mixins: [GrammemsService]
}
</script>

<style scoped>

</style>
