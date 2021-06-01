<template>
  <div>
    <div id="partOfSpeechComponent" :class="{'scroll-y': scrollable}">
      <!--Существительные-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.nouns"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.nouns = $event"
        :part-of-speech="partsOfSpeech.nouns">
      </BaseCasesTableComponent>
      <!--Прилагательные-->
      <AdjectiveCasesTableComponent
        v-if="partsOfSpeech.adjectives"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.adjectives = $event"
        :adjectives="partsOfSpeech.adjectives">
      </AdjectiveCasesTableComponent>
      <!--Глаголы-->
      <VerbWordComponent
        v-if="partsOfSpeech.verbs"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.verbs = $event"
        :verbs="partsOfSpeech.verbs">
      </VerbWordComponent>
      <!--Числительные-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.numerals"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.numerals = $event"
        :part-of-speech="partsOfSpeech.numerals">
      </BaseCasesTableComponent>
      <!--Порядковое числительное-->
      <BaseCasesFacesTableComponent
        v-if="partsOfSpeech.ordinals"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.ordinals = $event"
        :part-of-speech="partsOfSpeech.ordinals">
      </BaseCasesFacesTableComponent>
      <!--Местоимение-существительное-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.pronouns"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pronouns = $event"
        :part-of-speech="partsOfSpeech.pronouns">
      </BaseCasesTableComponent>
      <!--Местоимение-предикатив-->
      <BaseCasesTableComponent
        v-if="partsOfSpeech.pronounsPredicative"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pronounsPredicative = $event"
        :part-of-speech="partsOfSpeech.pronounsPredicative">
      </BaseCasesTableComponent>
      <!--Местоименное прилагательное-->
      <BaseCasesFacesTableComponent
        v-if="partsOfSpeech.pronominalAdjective"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pronominalAdjective = $event"
        :part-of-speech="partsOfSpeech.pronominalAdjective">
      </BaseCasesFacesTableComponent>
      <!--Наречие-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.adverbs"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.adverbs = $event"
        :part-of-speech="partsOfSpeech.adverbs">
      </UnchangeableWordComponent>
      <!--Предикатив-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.predicative"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.predicative = $event"
        :part-of-speech="partsOfSpeech.predicative">
      </UnchangeableWordComponent>
      <!--Предлог-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.pretext"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.pretext = $event"
        :part-of-speech="partsOfSpeech.pretext">
      </UnchangeableWordComponent>
      <!--Союз-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.conjunction"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.conjunction = $event"
        :part-of-speech="partsOfSpeech.conjunction">
      </UnchangeableWordComponent>
      <!--Междометие-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.interjection"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.interjection = $event"
        :part-of-speech="partsOfSpeech.interjection">
      </UnchangeableWordComponent>
      <!--Частица-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.particle"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.particle = $event"
        :part-of-speech="partsOfSpeech.particle">
      </UnchangeableWordComponent>
      <!--Вводное слово-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.parenthesis"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.parenthesis = $event"
        :part-of-speech="partsOfSpeech.parenthesis">
      </UnchangeableWordComponent>
      <!--Фразеологизм-->
      <UnchangeableWordComponent
        v-if="partsOfSpeech.phrase"
        :active-word-forms="activeWordForms"
        :word="word"
        @selected-words="selectedWords.phrase = $event"
        :part-of-speech="partsOfSpeech.phrase">
      </UnchangeableWordComponent>

      <div class="modal fade" data-backdrop="static" id="selectedJests" tabindex="-1" v-if="selectJests">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                Выбор жестов для словоформы <u><b>{{ activeWordFormInModal }}</b></u><br>
                <b>Граммемы</b>: {{ listOfGrammems(activeWordFormGrammemsInModal) }}<br>
                <b>Часть речи</b>: {{ descriptorToPartOfSpeech(activeWordFormPartOfSpeechInModal) }}
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <span><strong>Состав</strong></span>
              <div class="row mb-1 justify-content-center">
                <div class="navbar navbar-collapse">
                  <div class="nav-item">
                    <button class="btn btn-success">Открыть</button>
                  </div>
                  <div class="nav-item">
                    <button class="btn btn-primary" @click="move('up')">
                      ↑
                    </button>
                  </div>
                  <div class="nav-item">
                    <button class="btn btn-primary" @click="move('down')">
                      ↓
                    </button>
                  </div>
                  <div class="nav-item">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2"
                            @click="deleteSelectedJest">
                      <span>x</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <select class="mt-3 custom-select" size="5" v-model="selectedJest">
                    <option v-for="jest in selectedJests[activeCheckboxInJestsModal]"
                            :value="jest.jest.id_jest">
                      {{ jest.jest.jest }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-12">
                  <v-select
                    placeholder="Начните вводить название жеста для добавления"
                    :options="jestBySearch"
                    v-model="inputJest"
                    :reduce="jest => jest"
                    label="jest"
                    class="mt-2"
                    @search="searchJest"
                    :clear-search-on-select="true"
                    :filterable="false"
                    @input="selectJest"
                  >
                    <template slot="no-options">
                      Начните вводить название жеста
                    </template>
                    <template slot="option" slot-scope="option">
                      {{ option.jest }} <strong><sup>{{
                        (option.nedooformleno) ? '*' :
                          ''
                      }}</sup></strong>
                    </template>
                    <template slot="selected-option" slot-scope="option">
                      {{ option.jest }} <strong><sup>{{
                        (option.nedooformleno) ? '*' :
                          ''
                      }}</sup></strong>
                    </template>
                  </v-select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseCasesTableComponent from "./partsOfSpeech/BaseCasesTableComponent";
import VerbWordComponent from "./partsOfSpeech/VerbWordComponent";
import FacesCasesTableComponent from "./partsOfSpeech/ParticipleCasesTableComponent";
import BaseCasesFacesTableComponent from "./partsOfSpeech/BaseCasesFacesTableComponent";
import UnchangeableWordComponent from "./partsOfSpeech/UnchangeableWordComponent";
import AdjectiveCasesTableComponent from "./partsOfSpeech/AdjectiveCasesTableComponent";
import {uniqueWords} from "../../../../mixins/selectedWords";
import {GrammemsMixin} from "../../../../mixins/grammems";

export default {
  name: "PartOfSpeechTable",
  components: {
    AdjectiveCasesTableComponent,
    UnchangeableWordComponent,
    BaseCasesFacesTableComponent,
    FacesCasesTableComponent,
    VerbWordComponent,
    BaseCasesTableComponent
  },
  props: {
    word: {
      type: String,
      required: true
    },
    partsOfSpeechWord: {
      type: Object,
      required: true
    },
    selectJests: {
      type: Boolean,
      default: false
    },
    activeWordForms: {
      type: Array,
      required: true
    },
    selectedJests: {
      type: Object
    },
    scrollable: {
      type: Boolean
    }
  },
  data() {
    return {
      partsOfSpeech: {
        nouns: this.getPartOfSpeechData('Существительные'),
        adjectives: this.getPartOfSpeechData('Прилагательные'),
        verbs: this.getPartOfSpeechData('Глаголы'),
        numerals: this.getPartOfSpeechData('Числительные'),
        ordinals: this.getPartOfSpeechData('Порядковые числительные'),
        pronouns: this.getPartOfSpeechData('Местоимение-существительное'),
        pronounsPredicative: this.getPartOfSpeechData('Местоимение-предикатив'),
        pronominalAdjective: this.getPartOfSpeechData('Местоименное прилагательное'),
        adverbs: this.getPartOfSpeechData('Наречие'),
        predicative: this.getPartOfSpeechData('Предикатив'),
        pretext: this.getPartOfSpeechData('Предлог'),
        conjunction: this.getPartOfSpeechData('Союз'),
        interjection: this.getPartOfSpeechData('Междометие'),
        particle: this.getPartOfSpeechData('Частица'),
        parenthesis: this.getPartOfSpeechData('Вводное слово'),
        phrase: this.getPartOfSpeechData('Фразеологизм')
      },
      selectedWords: {
        nouns: [],
        adjectives: [],
        verbs: [],
        numerals: [],
        ordinals: [],
        pronouns: [],
        pronounsPredicative: [],
        pronominalAdjective: [],
        adverbs: [],
        predicative: [],
        pretext: [],
        conjunction: [],
        interjection: [],
        particle: [],
        parenthesis: [],
        phrase: [],
        all: []
      },
      inputJest: null, // Жест который выбрали в состав.
      jestBySearch: [], // Список жестов при поиске
      activeCheckboxInJestsModal: null, // Информация о словоформе, для которой открыто модальное окно с составом
      selectedJest: null
    }
  },
  mixins: [GrammemsMixin],
  watch: {
    selectedWords: {
      deep: true,
      handler() {
        this.$emit('selected-words', uniqueWords.call(this));
      }
    }
  },
  computed: {
    activeWordFormInModal() {
      if (this.activeCheckboxInJestsModal) {
        return JSON.parse(this.activeCheckboxInJestsModal)['Слово'].toLowerCase();
      }
    },
    activeWordFormGrammemsInModal() {
      if (this.activeCheckboxInJestsModal) {
        return JSON.parse(this.activeCheckboxInJestsModal)['Граммемы'];
      }
    },
    activeWordFormPartOfSpeechInModal() {
      if (this.activeCheckboxInJestsModal) {
        return JSON.parse(this.activeCheckboxInJestsModal)['Часть речи'];
      }
    }
  },
  methods: {
    getPartOfSpeechData(key) {
      return this.partsOfSpeechWord && this.partsOfSpeechWord[key] ? this.partsOfSpeechWord[key] : null
    },
    searchJest(search, loading) {
      loading(true);
      this.searchingJestProcess(search, loading, this);
    },
    searchingJestProcess: _.debounce((search, loading, vm) => {
      if (search !== "" && search != null) {
        axios
          .get(`/api/jest/search`, {
            params: {
              search,
            },
          })
          .then((response) => {
            vm.jestBySearch = response.data;
          });
      }
      loading(false);
    }, 350),
    initialSelectJests() {
      if (this.selectJests) {
        const that = this;

        const modal = $('#selectedJests');

        modal.on('hidden.bs.modal', () => {
          if (!this.selectedJests[this.activeCheckboxInJestsModal]) {
            $(`:checkbox[value='${this.activeCheckboxInJestsModal}']`).prop("checked", false);
          }

          this.activeCheckboxInJestsModal = null;
          this.$emit('selected-jests', this.selectedJests);
        });

        const allCheckBox = $('#partOfSpeechComponent input[type="checkbox"]');

        allCheckBox.parent().parent().parent().css('cursor', 'pointer');

        allCheckBox.click(function (event) {
          that.inputJest = null;
          if (this.checked) {
            modal.modal('show');
            that.activeCheckboxInJestsModal = this.value;
          } else {
            if (that.selectedJests[this.value]) {
              console.log('rew');
              delete that.selectedJests[this.value];
            }
          }
        }).parent().parent().parent().click(function () {
          if ($(this)[0]?.children[0]?.children[0]?.children[0]?.checked) {
            that.activeCheckboxInJestsModal = $(this)[0].children[0].children[0].children[0].value;
            modal.modal('show');
          }
        });
      }
    },
    selectJest() {
      if (!this.selectedJests[this.activeCheckboxInJestsModal]) {
        this.selectedJests[this.activeCheckboxInJestsModal] = [];
      }

      if (this.inputJest && !this.selectedJests[this.activeCheckboxInJestsModal]?.find(jest => jest.jest.id_jest === this.inputJest.id_jest)) {
        this.selectedJests[this.activeCheckboxInJestsModal].push({
          jest: this.inputJest,
          order: null
        });

        this.calculateOrder(this.selectedJests[this.activeCheckboxInJestsModal]);
      }
    },
    deleteSelectedJest() {
      const indexRemove = this.selectedJests[this.activeCheckboxInJestsModal]?.findIndex(jest => jest.jest.id_jest === this.selectedJest);

      if (indexRemove !== -1) {
        this.selectedJests[this.activeCheckboxInJestsModal].splice(indexRemove, 1);
        this.calculateOrder(this.selectedJests[this.activeCheckboxInJestsModal]);
        this.selectedJest = null;
      }
    },
    move(direction) {
      const index = this.selectedJests[this.activeCheckboxInJestsModal].indexOf(
        this.selectedJests[this.activeCheckboxInJestsModal].find(
          (jest) => jest.jest.id_jest === this.selectedJest
        )
      );
      const len = this.selectedJests[this.activeCheckboxInJestsModal].length - 1;
      if (direction === "up") {
        if (index > 0) {
          const temp = this.selectedJests[this.activeCheckboxInJestsModal][index];
          this.selectedJests[this.activeCheckboxInJestsModal][index] = this.selectedJests[this.activeCheckboxInJestsModal][
          index - 1
            ];
          this.selectedJests[this.activeCheckboxInJestsModal][index - 1] = temp;
        }
      } else if (direction === "down") {
        if (index < len) {
          const temp = this.selectedJests[this.activeCheckboxInJestsModal][index];
          this.selectedJests[this.activeCheckboxInJestsModal][index] = this.selectedJests[this.activeCheckboxInJestsModal][
          index + 1
            ];
          this.selectedJests[this.activeCheckboxInJestsModal][index + 1] = temp;
        }
      }
      this.calculateOrder(this.selectedJests[this.activeCheckboxInJestsModal]);
      this.$forceUpdate();
    },
    calculateOrder(selectedJests) {
      selectedJests?.forEach((item, index) => {
        selectedJests[index].order = index + 1;
      });
    },
  },
  mounted() {
    this.initialSelectJests();
  }
}
</script>

<style lang="scss">
.equals {
  color: red;
  font-weight: 600;

  .d-flex::after {
    content: url('/images/check_small.png');
    margin-right: 0;
    margin-left: 10px;
    position: relative;
    top: 2px;
  }
}

.form-check-inline {
  margin-right: 0;
}

.scroll-y {
  height: 500px;
  overflow-y: scroll;
}
</style>
