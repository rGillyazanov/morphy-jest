<template>
  <div>
    <div v-if="imperativeMood">
      <h4 class="text-center">Повелительное наклонение</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th>Единственное число</th>
          <th>Множественное число</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td :class="{ equals: equalsWithWord(imperativeMood['ЕД']) }">{{ imperativeMood['ЕД'].toLowerCase() }}</td>
          <td :class="{ equals: equalsWithWord(imperativeMood['МН']) }">{{ imperativeMood['МН'].toLowerCase() }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "ImperativeMoodTableComponent",
  props: {
    imperativeMood: {
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
