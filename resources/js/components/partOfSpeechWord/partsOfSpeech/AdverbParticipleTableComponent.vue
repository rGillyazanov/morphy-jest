<template>
  <div>
    <div v-if="adverbParticiple">
      <h4 class="text-center">Деепричаcтие</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th>Настоящее</th>
          <th>Прошедшее</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td :class="{ equals: equalsWithWord(adverbParticiple['Настоящее']) }">{{ adverbParticiple['Настоящее'] }}</td>
          <td :class="{ equals: equalsWithWord(adverbParticiple['Прошедшее']) }">{{ adverbParticiple['Прошедшее'] }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "AdverbParticipleTableComponent",
  props: {
    adverbParticiple: {
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
