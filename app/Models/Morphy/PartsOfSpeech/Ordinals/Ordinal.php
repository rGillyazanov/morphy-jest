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
        $masculineNormal = "-";
        $feminineNormal = "-";
        $neuterNormal = "-";
        $pluralNormal = "-";

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))) > 0) {
            $masculineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getWord();
        }

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine();
        $singular->getFeminine();
        $singular->getNeuter();

        $plural = new Plural($pluralNormal);

        return new CaseWord($singular, $plural);
    }

    private function setOrdinals(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('ЧИСЛ-П') as $paradigm) {
            $this->_ordinals[$paradigm->getBaseForm()] = [
                'Именительный' => $this->setCase($paradigm, ["ИМ"]),
                'Родительный' => $this->setCase($paradigm, ["РД"]),
                'Дательный' => $this->setCase($paradigm, ["ДТ"]),
                'Винительный' => $this->setCase($paradigm, ["ВН"]),
                'Творительный' => $this->setCase($paradigm, ["ТВ"]),
                'Предложный' => $this->setCase($paradigm, ["ПР"])
            ];
        }
    }
}
