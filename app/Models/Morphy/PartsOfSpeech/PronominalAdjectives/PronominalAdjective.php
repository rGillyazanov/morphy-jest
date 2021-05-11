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

    private function setPronominalAdjective(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('МС-П') as $paradigm) {
            $this->_pronominalAdjectives[$paradigm->getBaseForm()] = [
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
