<?php

namespace app\Models\Morphy\PartsOfSpeech\Numerals;

use phpMorphy_Paradigm_ParadigmInterface;
use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\PluralSingular;

class Numeral extends BasePartOfSpeech
{
    /**
     * Числительные
     * @var array
     */
    private array $_numerals;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setNumerals();
    }

    /**
     * @return array
     */
    public function getNumerals(): array
    {
        return $this->_numerals;
    }

    /**
     * Устанавливает падеж.
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param string $case - падеж
     * @return PluralSingular
     */
    private function setCase(phpMorphy_Paradigm_ParadigmInterface $paradigm, string $case)
    {
        $singular = "-";
        $plural = "-";

        if (count($paradigm->getWordFormsByGrammems([$case])) > 0) {
            $singular = $paradigm->getWordFormsByGrammems([$case])[0]->getWord();
        }

        return new PluralSingular(
            $singular,
            $plural
        );
    }

    private function setNumerals(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('ЧИСЛ') as $paradigm) {
            $this->_numerals[$paradigm->getBaseForm()] = [
                'Именительный' => $this->setCase($paradigm, "ИМ"),
                'Родительный' => $this->setCase($paradigm, "РД"),
                'Дательный' => $this->setCase($paradigm, "ДТ"),
                'Винительный' => $this->setCase($paradigm, "ВН"),
                'Творительный' => $this->setCase($paradigm, "ТВ"),
                'Предложный' => $this->setCase($paradigm, "ПР")
            ];
        }
    }
}
