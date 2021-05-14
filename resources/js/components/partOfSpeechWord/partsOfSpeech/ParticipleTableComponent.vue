<template>
  <div>
    <div v-if="participle" v-for="participleTime in Object.keys(participle)">

      <div v-for="participleVoice in Object.keys(participle[participleTime])">
        <h4 class="text-center">Причастие - {{ participleTime.toLowerCase() }}, {{ participleVoice.toLowerCase() }}</h4>
        <table class="table table-bordered">
          <thead class="thead-light">
          <tr>
            <th rowspan="2">&nbsp;</th>
            <th colspan="3" class="text-center">Единственное число</th>
            <th rowspan="2" class="align-middle">Множественное число</th>
          </tr>
          <tr>
            <th>Мужской род</th>
            <th>Женский род</th>
            <th>Средний род</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="participleCase in Object.keys(participle[participleTime][participleVoice])">
            <th>{{ participleCase }}</th>
            <td
              :class="{ equals: equalsWithWord(participle[participleTime][participleVoice][participleCase]['ЕД']['МР']['НОРМ']) }">
              {{ participle[participleTime][participleVoice][participleCase]['ЕД']['МР']['НОРМ'] }}
            </td>
            <td
              :class="{ equals: equalsWithWord(participle[participleTime][participleVoice][participleCase]['ЕД']['ЖР']['НОРМ']) }">
              {{ participle[participleTime][participleVoice][participleCase]['ЕД']['ЖР']['НОРМ'] }}
            </td>
            <td
              :class="{ equals: equalsWithWord(participle[participleTime][participleVoice][participleCase]['ЕД']['СР']['НОРМ']) }">
              {{ participle[participleTime][participleVoice][participleCase]['ЕД']['СР']['НОРМ'] }}
            </td>
            <td
              :class="{ equals: equalsWithWord(participle[participleTime][participleVoice][participleCase]['МН']['НОРМ']) }">
              {{ participle[participleTime][participleVoice][participleCase]['МН']['НОРМ'] }}
            </td>
          </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</template>

<script>
import {GrammemsService} from "../../../mixins/grammems";

export default {
  name: "ParticipleTableComponent",
  props: {
    participle: {
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
