<template>
  <div>
    <div v-if="presentTime">
      <h4 class="text-center">Настоящее время</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th scope="col">Лицо</th>
          <th scope="col">Единственное число</th>
          <th scope="col">Множественное число</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="face in Object.keys(presentTime)">
          <th scope="row">{{ face }}</th>
          <td :class="{ equals: equalsWithWord(presentTime[face]['ЕД']) }">{{ presentTime[face]['ЕД'] }}</td>
          <td :class="{ equals: equalsWithWord(presentTime[face]['МН']) }">{{ presentTime[face]['МН'] }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "PresentTimeTableComponent",
  props: {
    presentTime: {
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
