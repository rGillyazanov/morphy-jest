<template>
  <div>
    <div v-if="pastTime">
      <h4 class="text-center">Прошедшее время</h4>
      <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
          <th colspan="3">Единственное число</th>
          <th rowspan="2" class="text-center align-middle">Множественное число</th>
        </tr>
        <tr>
          <th>мужской</th>
          <th>женский</th>
          <th>средний</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td :class="{ equals: equalsWithWord(pastTime['ЕД']['МР']['НОРМ']) }">{{ pastTime['ЕД']['МР']['НОРМ'] }}</td>
          <td :class="{ equals: equalsWithWord(pastTime['ЕД']['ЖР']['НОРМ']) }">{{ pastTime['ЕД']['ЖР']['НОРМ'] }}</td>
          <td :class="{ equals: equalsWithWord(pastTime['ЕД']['СР']['НОРМ']) }">{{ pastTime['ЕД']['СР']['НОРМ'] }}</td>
          <td :class="{ equals: equalsWithWord(pastTime['МН']['НОРМ']) }">{{ pastTime['МН']['НОРМ'] }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "PastTimeTableComponent",
  props: {
    pastTime: {
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
