<?php

namespace App\Models\Morphy\PartsOfSpeech\Adjectives;

use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;
use phpMorphy_Paradigm_ParadigmInterface;

class Adjective extends BasePartOfSpeech
{
    /**
     * Прилагательные
     * @var array
     */
    private array $_adjectives;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setAdjective();
    }

    /**
     * @return array
     */
    public function getAdjectives(): array
    {
        return $this->_adjectives;
    }

    /**
     * Устанавливает падеж.
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param string $case - падеж
     * @return CaseWord
     */
    private function setCase(phpMorphy_Paradigm_ParadigmInterface $paradigm, string $case): CaseWord
    {
        $masculineNormal = "-";
        $feminineNormal = "-";
        $neuterNormal = "-";

        $masculineDegree = "-";
        $feminineDegree = "-";
        $neuterDegree = "-";

        $pluralNormal = "-";
        $pluralDegree = "-";

        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД', 'МР'])) > 0) {
            $masculineNormal = $paradigm->getWordFormsByGrammems([$case, 'ЕД', 'МР'])[0]->getWord();
        }
        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД', 'МР', 'ПРЕВ'])) > 0) {
            $masculineDegree = $paradigm->getWordFormsByGrammems([$case, 'ЕД', 'МР', 'ПРЕВ'])[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД', 'ЖР'])) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems([$case, 'ЕД', 'ЖР'])[0]->getWord();
        }
        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД', 'ЖР', 'ПРЕВ'])) > 0) {
            $feminineDegree = $paradigm->getWordFormsByGrammems([$case, 'ЕД', 'ЖР', 'ПРЕВ'])[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД', 'СР'])) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems([$case, 'ЕД', 'СР'])[0]->getWord();
        }
        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД', 'СР', 'ПРЕВ'])) > 0) {
            $neuterDegree = $paradigm->getWordFormsByGrammems([$case, 'ЕД', 'СР', 'ПРЕВ'])[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems([$case, 'МН'])) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems([$case, 'МН'])[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems([$case, 'МН', 'ПРЕВ'])) > 0) {
            $pluralDegree = $paradigm->getWordFormsByGrammems([$case, 'МН', 'ПРЕВ'])[0]->getWord();
        }

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine()->setDegree($masculineDegree);
        $singular->getFeminine()->setDegree($feminineDegree);
        $singular->getNeuter()->setDegree($neuterDegree);

        $plural = new Plural($pluralNormal);

        $plural->getKind()->setDegree($pluralDegree);

        return new CaseWord($singular, $plural);
    }

    private function setAdjective(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('П') as $paradigm) {
            $this->_adjectives[$paradigm->getBaseForm()] = [
                'Именительный' => $this->setCase($paradigm, "ИМ"),
                'Родительный' => $this->setCase($paradigm, "РД"),
                'Дательный' => $this->setCase($paradigm, "ДТ"),
                'Винительный' => $this->setCase($paradigm, "ВН"),
                'Творительный' => $this->setCase($paradigm, "ТВ"),
                'Предложный' => $this->setCase($paradigm, "ПР"),
                'Звательный' => $this->setCase($paradigm, "ЗВ")
            ];
        }
    }
}
