<?php

namespace App\Models\Morphy\PartsOfSpeech\Ordinals;

use phpMorphy_Paradigm_ParadigmInterface;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;

class Ordinal extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Порядковые числительные
     * @var array
     */
    private array $_ordinals;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setOrdinals();
    }

    /**
     * @return array
     */
    public function getOrdinals(): array
    {
        return $this->_ordinals;
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
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getWord();
            $feminineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getPartOfSpeech();
            $feminineNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getWord();
            $neuterNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getPartOfSpeech();
            $neuterNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getWord();
            $pluralNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getPartOfSpeech();
            $pluralNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getGrammems();
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

    private function setOrdinals(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('ЧИСЛ-П') as $paradigm) {
            $this->_ordinals[$paradigm->getBaseForm()]['Падежи'] = [
                'Именительный' => $this->setCase($paradigm, ["ИМ"]),
                'Родительный' => $this->setCase($paradigm, ["РД"]),
                'Дательный' => $this->setCase($paradigm, ["ДТ"]),
                'Винительный' => $this->setCase($paradigm, ["ВН"]),
                'Творительный' => $this->setCase($paradigm, ["ТВ"]),
                'Предложный' => $this->setCase($paradigm, ["ПР"])
            ];

            $this->_ordinals[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_ordinals[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
