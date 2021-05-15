<template>
  <div>
    <hr>
    <div v-if="partOfSpeech" v-for="wordTemp in Object.keys(partOfSpeech)">
      <div class="py-3"><b>Базовая форма</b>: {{ wordTemp }} -
        {{ listOfGrammems(partOfSpeech[wordTemp]['Граммемы']) }}
      </div>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th scope="col">Падеж</th>
          <th scope="col">Единственное число</th>
          <th scope="col">Множественное число</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="casePart in Object.keys(partOfSpeech[wordTemp]['Падежи'])">
          <th scope="row">{{ casePart }}</th>
          <td :class="{ equals: equalsWithWord(partOfSpeech[wordTemp]['Падежи'][casePart]['ЕД']) }">
            {{ partOfSpeech[wordTemp]['Падежи'][casePart]['ЕД'].toLowerCase() }}
          </td>
          <td :class="{ equals: equalsWithWord(partOfSpeech[wordTemp]['Падежи'][casePart]['МН']) }">
            {{ partOfSpeech[wordTemp]['Падежи'][casePart]['МН'].toLowerCase() }}
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "BaseCasesTableComponent",
  props: {
    partOfSpeech: {
      type: Object | null,
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
