<?php

namespace App\Models\Morphy\PartsOfSpeech\PronominalAdjectives;

use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;
use phpMorphy_Paradigm_ParadigmInterface;

class PronominalAdjective extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Местоименное прилагательное
     * @var array
     */
    private array $_pronominalAdjectives;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setPronominalAdjective();
    }

    /**
     * @return array
     */
    public function getPronominalAdjective(): array
    {
        return $this->_pronominalAdjectives;
    }

    /**
     * Устанавливает падеж.
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param array $case - падеж
     * @return CaseWord
     */
    private function setCase(phpMorphy_Paradigm_ParadigmInterface $paradigm, array $case)
    {
        $pluralNormal = "-";
        $pluralNormalGrammems = [];
        $pluralNormalPartOfSpeech = "-";

        $masculineNormal = "-";
        $masculineNormalGrammems = [];
        $masculineNormalPartOfSpeech = "-";

        $feminineNormal = "-";
        $feminineNormalGrammems = [];
        $feminineNormalPartOfSpeech = "-";

        $neuterNormal = "-";
        $neuterNormalGrammems = [];
        $neuterNormalPartOfSpeech = "-";

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

        return new CaseWord($singular, $plural);
    }

    private function setPronominalAdjective(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('МС-П') as $paradigm) {
            $this->_pronominalAdjectives[$paradigm->getBaseForm()]['Падежи']  = [
                'Именительный' => $this->setCase($paradigm, ["ИМ"]),
                'Родительный' => $this->setCase($paradigm, ["РД"]),
                'Дательный' => $this->setCase($paradigm, ["ДТ"]),
                'Винительный' => $this->setCase($paradigm, ["ВН"]),
                'Творительный' => $this->setCase($paradigm, ["ТВ"]),
                'Предложный' => $this->setCase($paradigm, ["ПР"])
            ];

            $this->_pronominalAdjectives[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_pronominalAdjectives[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
