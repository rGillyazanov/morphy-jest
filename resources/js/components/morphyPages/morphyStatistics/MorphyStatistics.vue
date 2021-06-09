<template>
  <div>
    <template v-if="!loadingStatistics">
      <h1>Статистика</h1>
      <ol>
        <li>Сколько жестов обработано: {{ statistics.countJests }}</li>
        <li>Сколько слов обработано: {{ statistics.countWords }}</li>
        <li>Сколько словоформ сгенерировано: {{ statistics.countWordForms }}</li>
        <li>Сколько словоформ связано: {{ statistics.countSvyaz }}</li>
        <li>Сколько словоформ несвязано: {{ statistics.countNotSvyaz }}</li>
        <li>Сколько словоформ имеют единичную связь с жестом.</li>
        <li>Сколько словоформ имеют единичную связь с несколькими жестами.</li>
        <li>Сколько словоформ имеют единичную связь с несколькими жестами.</li>
      </ol>
    </template>
    <div v-else>
      <div class="row">
        <div class="col-12 mt-4">
          <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MorphyStatistics",
  data() {
    return {
      statistics: {
        countJests: 0,
        countWords: 0,
        countWordForms: 0,
        countSvyaz: 0,
        countNotSvyaz: 0,
      },
      loadingStatistics: true
    }
  },
  mounted() {
    this.loadingStatistics = true;
    axios.get('/api/statistics').then(response => {
      this.statistics.countJests = response.data['жестов обработано'];
      this.statistics.countWords = response.data['слов обработано'];
      this.statistics.countWordForms = response.data['словоформ сгенерировано'];
      this.statistics.countSvyaz = response.data['словоформ связано'];
      this.statistics.countNotSvyaz = response.data['словоформ несвязано'];

      this.loadingStatistics = false;
    });
  }
}
</script>

<style scoped lang="scss">

</style>
