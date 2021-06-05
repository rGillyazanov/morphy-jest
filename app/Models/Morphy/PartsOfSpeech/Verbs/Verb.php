<?php

namespace App\Models\Morphy\PartsOfSpeech\Verbs;

use App\Models\Morphy\HelpMorphyService;
use App\Models\Morphy\MorphyAnalyzer;
use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;

use phpMorphy_Paradigm_ParadigmInterface;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\PluralSingular;

class Verb extends BasePartOfSpeech
{
    private array $_verbs;

    private HelpMorphyService $helpMorphyService;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->helpMorphyService = new HelpMorphyService();

        $this->setVerb();
    }

    /**
     * @return array
     */
    public function getVerbs(): array
    {
        return $this->_verbs;
    }

  /**
   * Устанавливает падеж.
   * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
   * @param array $case - падеж
   * @return CaseWord|false
   */
    private function setCase(phpMorphy_Paradigm_ParadigmInterface $paradigm, array $case)
    {
        $masculineNormal = "-";
        $masculineNormalGrammems = [];
        $masculineNormalPartOfSpeech = "-";

        $feminineNormal = "-";
        $feminineNormalGrammems = [];
        $feminineNormalPartOfSpeech = "-";

        $neuterNormal = "-";
        $neuterNormalGrammems = [];
        $neuterNormalPartOfSpeech = "-";

        $pluralNormal = "-";
        $pluralNormalGrammems = [];
        $pluralNormalPartOfSpeech = "-";

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))) > 0) {
            $masculineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getWord();
            $masculineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getPartOfSpeech();

            $masculineNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getGrammems();

            if (array_search('ОД', $case)) {
                unset($masculineNormalGrammems[array_search('НО', $masculineNormalGrammems)]);
            } elseif (array_search('НО', $case)) {
                unset($masculineNormalGrammems[array_search('ОД', $masculineNormalGrammems)]);
            } elseif (in_array('ОД', $masculineNormalGrammems) && in_array('НО', $masculineNormalGrammems)) {
                unset($masculineNormalGrammems[array_search('НО', $masculineNormalGrammems)]);
            }
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getWord();
            $feminineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getPartOfSpeech();
            $feminineNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getGrammems();

            if (array_search('ОД', $case)) {
                unset($feminineNormalGrammems[array_search('НО', $feminineNormalGrammems)]);
            } elseif (array_search('НО', $case)) {
                unset($feminineNormalGrammems[array_search('ОД', $feminineNormalGrammems)]);
            } elseif (in_array('ОД', $feminineNormalGrammems) && in_array('НО', $feminineNormalGrammems)) {
                unset($feminineNormalGrammems[array_search('НО', $feminineNormalGrammems)]);
            }
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getWord();
            $neuterNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getPartOfSpeech();
            $neuterNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getGrammems();

            if (array_search('ОД', $case)) {
                unset($neuterNormalGrammems[array_search('НО', $neuterNormalGrammems)]);
            } elseif (array_search('НО', $case)) {
                unset($neuterNormalGrammems[array_search('ОД', $neuterNormalGrammems)]);
            } elseif (in_array('ОД', $neuterNormalGrammems) && in_array('НО', $neuterNormalGrammems)) {
                unset($neuterNormalGrammems[array_search('НО', $neuterNormalGrammems)]);
            }
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getWord();
            $pluralNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getPartOfSpeech();
            $pluralNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getGrammems();

            if (array_search('ОД', $case)) {
                unset($pluralNormalGrammems[array_search('НО', $pluralNormalGrammems)]);
            } elseif (array_search('НО', $case)) {
                unset($pluralNormalGrammems[array_search('ОД', $pluralNormalGrammems)]);
            } elseif (in_array('ОД', $pluralNormalGrammems) && in_array('НО', $pluralNormalGrammems)) {
                unset($pluralNormalGrammems[array_search('НО', $pluralNormalGrammems)]);
            }
        }

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine()->setNormalGrammems($masculineNormalGrammems);
        $singular->getMasculine()->setNormalPartOfSpeech($masculineNormalPartOfSpeech);

        $singular->getFeminine()->setNormalGrammems($feminineNormalGrammems);
        $singular->getFeminine()->setNormalPartOfSpeech($feminineNormalPartOfSpeech);

        $singular->getNeuter()->setNormalGrammems($neuterNormalGrammems);
        $singular->getNeuter()->setNormalPartOfSpeech($neuterNormalPartOfSpeech);

        $plural = new Plural($pluralNormal);
        $plural->getKind()->setNormalGrammems($pluralNormalGrammems);
        $plural->getKind()->setNormalPartOfSpeech($pluralNormalPartOfSpeech);

        if ($masculineNormal === '-' && $feminineNormal === '-' && $neuterNormal === '-' && $pluralNormal === '-') {
          return false;
        }

        return new CaseWord($singular, $plural);
    }

    /**
     * Устанавливает настоящее время
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @return array|null
     */
    private function setPresentTime(phpMorphy_Paradigm_ParadigmInterface $paradigm): ?array
    {
        $faces = [
            '1Л' => [
                'ЕД' => $this->helpMorphyService->getWordByGrammars($paradigm, ['1Л', 'ЕД', 'НСТ']),
                'МН' => $this->helpMorphyService->getWordByGrammars($paradigm, ['1Л', 'МН', 'НСТ']),
            ],
            '2Л' => [
                'ЕД' => $this->helpMorphyService->getWordByGrammars($paradigm, ['2Л', 'ЕД', 'НСТ']),
                'МН' => $this->helpMorphyService->getWordByGrammars($paradigm, ['2Л', 'МН', 'НСТ']),
            ],
            '3Л' => [
                'ЕД' => $this->helpMorphyService->getWordByGrammars($paradigm, ['3Л', 'ЕД', 'НСТ']),
                'МН' => $this->helpMorphyService->getWordByGrammars($paradigm, ['3Л', 'МН', 'НСТ']),
            ]
        ];

        $pluralSingular1 = new PluralSingular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['1Л', 'ЕД', 'НСТ']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['1Л', 'МН', 'НСТ']),
        );

        $singularPartOfSpeech1 = '-';
        $singularGrammems1 = [];

        $pluralPartOfSpeech1 = '-';
        $pluralGrammems1 = [];

        if (count($paradigm->getWordFormsByGrammems(['1Л', 'ЕД', 'НСТ'])) > 0) {
            $singularPartOfSpeech1 = $paradigm->getWordFormsByGrammems(['1Л', 'ЕД', 'НСТ'])[0]->getPartOfSpeech();
            $singularGrammems1 = $paradigm->getWordFormsByGrammems(['1Л', 'ЕД', 'НСТ'])[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(['1Л', 'МН', 'НСТ'])) > 0) {
            $pluralPartOfSpeech1 = $paradigm->getWordFormsByGrammems(['1Л', 'МН', 'НСТ'])[0]->getPartOfSpeech();
            $pluralGrammems1 = $paradigm->getWordFormsByGrammems(['1Л', 'МН', 'НСТ'])[0]->getGrammems();
        }

        $pluralSingular1->setSingularGrammems($singularGrammems1);
        $pluralSingular1->setPluralGrammems($pluralGrammems1);
        $pluralSingular1->setSingularPartOfSpeech($singularPartOfSpeech1);
        $pluralSingular1->setPluralPartOfSpeech($pluralPartOfSpeech1);

        $pluralSingular2 = new PluralSingular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['2Л', 'ЕД', 'НСТ']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['2Л', 'МН', 'НСТ']),
        );

        $singularPartOfSpeech2 = '-';
        $singularGrammems2 = [];

        $pluralPartOfSpeech2 = '-';
        $pluralGrammems2 = [];

        if (count($paradigm->getWordFormsByGrammems(['2Л', 'ЕД', 'НСТ'])) > 0) {
            $singularPartOfSpeech2 = $paradigm->getWordFormsByGrammems(['2Л', 'ЕД', 'НСТ'])[0]->getPartOfSpeech();
            $singularGrammems2 = $paradigm->getWordFormsByGrammems(['2Л', 'ЕД', 'НСТ'])[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(['2Л', 'МН', 'НСТ'])) > 0) {
            $pluralPartOfSpeech2 = $paradigm->getWordFormsByGrammems(['2Л', 'МН', 'НСТ'])[0]->getPartOfSpeech();
            $pluralGrammems2 = $paradigm->getWordFormsByGrammems(['2Л', 'МН', 'НСТ'])[0]->getGrammems();
        }

        $pluralSingular2->setSingularGrammems($singularGrammems2);
        $pluralSingular2->setPluralGrammems($pluralGrammems2);
        $pluralSingular2->setSingularPartOfSpeech($singularPartOfSpeech2);
        $pluralSingular2->setPluralPartOfSpeech($pluralPartOfSpeech2);

        $pluralSingular3 = new PluralSingular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['3Л', 'ЕД', 'НСТ']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['3Л', 'МН', 'НСТ']),
        );

        $singularPartOfSpeech3 = '-';
        $singularGrammems3 = [];

        $pluralPartOfSpeech3 = '-';
        $pluralGrammems3 = [];

        if (count($paradigm->getWordFormsByGrammems(['3Л', 'ЕД', 'НСТ'])) > 0) {
            $singularPartOfSpeech3 = $paradigm->getWordFormsByGrammems(['3Л', 'ЕД', 'НСТ'])[0]->getPartOfSpeech();
            $singularGrammems3 = $paradigm->getWordFormsByGrammems(['3Л', 'ЕД', 'НСТ'])[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(['3Л', 'МН', 'НСТ'])) > 0) {
            $pluralPartOfSpeech3 = $paradigm->getWordFormsByGrammems(['3Л', 'МН', 'НСТ'])[0]->getPartOfSpeech();
            $pluralGrammems3 = $paradigm->getWordFormsByGrammems(['3Л', 'МН', 'НСТ'])[0]->getGrammems();
        }

        $pluralSingular3->setSingularGrammems($singularGrammems3);
        $pluralSingular3->setPluralGrammems($pluralGrammems3);
        $pluralSingular3->setSingularPartOfSpeech($singularPartOfSpeech3);
        $pluralSingular3->setPluralPartOfSpeech($pluralPartOfSpeech3);

        foreach ($faces as $face) {
            foreach ($face as $word) {
                if ($word !== '-') {
                    return [
                        1 => $pluralSingular1,
                        2 => $pluralSingular2,
                        3 => $pluralSingular3
                    ];
                }
            }
        }

        return null;
    }

    /**
     * Устанавливает прошедшее время
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @return CaseWord
     */
    private function setPastTime(phpMorphy_Paradigm_ParadigmInterface $paradigm): CaseWord
    {
        $plural = new Plural(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'МН'])
        );

        $pluralNormalPartOfSpeech = '-';
        $pluralNormalGrammems = [];

        if (count($paradigm->getWordFormsByGrammems(['ПРШ', 'МН'])) > 0) {
            $pluralNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(['ПРШ', 'МН'])[0]->getPartOfSpeech();
            $pluralNormalGrammems = $paradigm->getWordFormsByGrammems(['ПРШ', 'МН'])[0]->getGrammems();
        }

        $plural->getKind()->setNormalGrammems($pluralNormalGrammems);
        $plural->getKind()->setNormalPartOfSpeech($pluralNormalPartOfSpeech);

        $masculineNormalGrammems = [];
        $masculineNormalPartOfSpeech = '-';
        $feminineNormalGrammems = [];
        $feminineNormalPartOfSpeech = '-';
        $neuterNormalGrammems = [];
        $neuterNormalPartOfSpeech = '-';

        if (count($paradigm->getWordFormsByGrammems(['ПРШ', 'МР', 'ЕД'])) > 0) {
            $masculineNormalGrammems = $paradigm->getWordFormsByGrammems(['ПРШ', 'МР', 'ЕД'])[0]->getGrammems();
            $masculineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(['ПРШ', 'МР', 'ЕД'])[0]->getPartOfSpeech();
        }

        if (count($paradigm->getWordFormsByGrammems(['ПРШ', 'ЖР', 'ЕД'])) > 0) {
            $feminineNormalGrammems = $paradigm->getWordFormsByGrammems(['ПРШ', 'ЖР', 'ЕД'])[0]->getGrammems();
            $feminineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(['ПРШ', 'ЖР', 'ЕД'])[0]->getPartOfSpeech();
        }

        if (count($paradigm->getWordFormsByGrammems(['ПРШ', 'СР', 'ЕД'])) > 0) {
            $neuterNormalGrammems = $paradigm->getWordFormsByGrammems(['ПРШ', 'СР', 'ЕД'])[0]->getGrammems();
            $neuterNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(['ПРШ', 'СР', 'ЕД'])[0]->getPartOfSpeech();
        }

        $singular = new Singular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'МР', 'ЕД']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'ЖР', 'ЕД']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'СР', 'ЕД']),
        );

        $singular->getMasculine()->setNormalGrammems($masculineNormalGrammems);
        $singular->getMasculine()->setNormalPartOfSpeech($masculineNormalPartOfSpeech);

        $singular->getFeminine()->setNormalGrammems($feminineNormalGrammems);
        $singular->getFeminine()->setNormalPartOfSpeech($feminineNormalPartOfSpeech);

        $singular->getNeuter()->setNormalGrammems($neuterNormalGrammems);
        $singular->getNeuter()->setNormalPartOfSpeech($neuterNormalPartOfSpeech);

        return new CaseWord($singular, $plural);
    }

    /**
     * Устанавливает повелительное наклонение
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @return PluralSingular
     */
    private function setImperativeMood(phpMorphy_Paradigm_ParadigmInterface $paradigm): PluralSingular
    {
        $imperativeMood = new PluralSingular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПВЛ', 'ЕД']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПВЛ', 'МН', '2Л'])
        );

        $singularGrammems = [];
        $singularPartOfSpeech = '-';

        $pluralGrammems = [];
        $pluralPartOfSpeech = '-';

        if (count($paradigm->getWordFormsByGrammems(['ПВЛ', 'ЕД'])) > 0) {
            $singularGrammems = $paradigm->getWordFormsByGrammems(['ПВЛ', 'ЕД'])[0]->getGrammems();
            $singularPartOfSpeech = $paradigm->getWordFormsByGrammems(['ПВЛ', 'ЕД'])[0]->getPartOfSpeech();
        }

        if (count($paradigm->getWordFormsByGrammems(['ПВЛ', 'МН', '2Л'])) > 0) {
            $pluralGrammems = $paradigm->getWordFormsByGrammems(['ПВЛ', 'МН', '2Л'])[0]->getGrammems();
            $pluralPartOfSpeech = $paradigm->getWordFormsByGrammems(['ПВЛ', 'МН', '2Л'])[0]->getPartOfSpeech();
        }

        $imperativeMood->setSingularGrammems($singularGrammems);
        $imperativeMood->setSingularPartOfSpeech($singularPartOfSpeech);

        $imperativeMood->setPluralGrammems($pluralGrammems);
        $imperativeMood->setPluralPartOfSpeech($pluralPartOfSpeech);

        return $imperativeMood;
    }

    /**
     * Устанавливает таблицу с падежами определенной грамматики
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param array $grammems
     * @return array|null
     */
    private function setTableWithCases(phpMorphy_Paradigm_ParadigmInterface $paradigm, $grammems = []): ?array
    {
        $im = ['ИМ'];
        $rd = ['РД'];
        $dt = ['ДТ'];
        $vnOd = ['ВН', 'ОД'];
        $vnNo = ['ВН', 'НО'];
        $tv = ['ТВ'];
        $pr = ['ПР'];

        $masculineNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'МР']));
        $feminineNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'ЖР']));
        $neuterNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'СР']));
        $pluralNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['МН']));

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine()->setNormalGrammems((array)$this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'МР']), 'grammems'));
        $singular->getMasculine()->setNormalPartOfSpeech($this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'МР']), 'partOfSpeech'));

        $singular->getFeminine()->setNormalGrammems((array)$this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'ЖР']), 'grammems'));
        $singular->getFeminine()->setNormalPartOfSpeech($this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'ЖР']), 'partOfSpeech'));

        $singular->getNeuter()->setNormalGrammems((array)$this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'СР']), 'grammems'));
        $singular->getNeuter()->setNormalPartOfSpeech($this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'СР']), 'partOfSpeech'));

        $plural = new Plural($pluralNormal);

        $plural->getKind()->setNormalGrammems((array)$this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['МН']),  'grammems'));
        $plural->getKind()->setNormalPartOfSpeech($this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['МН']), 'partOfSpeech'));

        $caseWord = new CaseWord($singular, $plural);

        $cases = [
          'Именительный' => $this->setCase($paradigm, array_merge($grammems, $im)),
          'Родительный' => $this->setCase($paradigm, array_merge($grammems, $rd)),
          'Дательный' => $this->setCase($paradigm, array_merge($grammems, $dt)),
          'Винительный (Одушевленный)' => $this->setCase($paradigm, array_merge($grammems, $vnOd)),
          'Винительный (Неодушевленный)' => $this->setCase($paradigm, array_merge($grammems, $vnNo)),
          'Творительный' => $this->setCase($paradigm, array_merge($grammems, $tv)),
          'Предложный' => $this->setCase($paradigm, array_merge($grammems, $pr)),
        ];

        foreach ($cases as $case) {
          if ($case) {
            break;
          }

          return null;
        }

        $cases['Краткое причастие'] = $caseWord;

        return $cases;
    }

    /**
     * Возвращает массив содержащий слово, его граммемы и часть речи.
     * @param $searchPartOfSpeech
     * @param $searchGrammems
     * @return array
     */
    private function setAdverbParticiple($searchPartOfSpeech, $searchGrammems)
    {
        $word = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech(
            $this->_paradigms,
            $searchPartOfSpeech,
            $searchGrammems
        );

        $grammems = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech(
            $this->_paradigms,
            $searchPartOfSpeech,
            $searchGrammems,
            'grammems'
        );

        $partOfSpeech = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech(
            $this->_paradigms,
            $searchPartOfSpeech,
            $searchGrammems,
            'partOfSpeech'
        );

        return [
            'Информация' => [
                'Слово' => $word,
                'Граммемы' => $grammems,
                'Часть речи' => $partOfSpeech
            ],
            'Жесты' => HelpMorphyService::hasInJests($word, $grammems, $partOfSpeech)
        ];
    }

    private function setVerb(): void
    {
        foreach ($this->_paradigms->getByPartOfSpeech('ИНФИНИТИВ') as $paradigm) {
            $this->_verbs[$paradigm->getBaseForm()] = [
                'Время' => [
                    'Настоящее' => $this->setPresentTime($paradigm),
                    'Прошедшее' => $this->setPastTime($paradigm)
                ],
                'Повелительное наклонение' => $this->setImperativeMood($paradigm),
                'Деепричастие' => [
                    'Настоящее' => $this->setAdverbParticiple('ДЕЕПРИЧАСТИЕ', ['НСТ']),
                    'Прошедшее' => $this->setAdverbParticiple('ДЕЕПРИЧАСТИЕ', ['ПРШ'])
                ],
                'Причастие' => [
                    'Настоящее время' => [
                        'Действительный залог' => $this->setTableWithCases($paradigm, ['ДСТ', 'НСТ']),
                        'Страдательный залог' => $this->setTableWithCases($paradigm, ['СТР', 'НСТ'])
                    ],
                    'Прошедшее время' => [
                        'Действительный залог' => $this->setTableWithCases($paradigm, ['ДСТ', 'ПРШ']),
                        'Страдательный залог' => $this->setTableWithCases($paradigm, ['СТР', 'ПРШ'])
                    ]
                ]
            ];

            $this->_verbs[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
              if ($paradigm->getBaseForm() === $form->getWord()) {
                array_unshift($this->_verbs[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                break;
              }
            }
        }
    }
}
