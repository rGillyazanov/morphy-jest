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
        $singularGrammems = [];
        $singularPartOfSpeech = "-";

        $plural = "-";
        $pluralGrammems = [];
        $pluralPartOfSpeech = "-";

        if (count($paradigm->getWordFormsByGrammems([$case])) > 0) {
            $singular = $paradigm->getWordFormsByGrammems($case)[0]->getWord();
            $singularPartOfSpeech = $paradigm->getWordFormsByGrammems($case)[0]->getPartOfSpeech();
            $singularGrammems = $paradigm->getWordFormsByGrammems($case)[0]->getGrammems();
        }

        $pluralSingular = new PluralSingular(
            $singular,
            $plural
        );

        $pluralSingular->setSingularGrammems($singularGrammems);
        $pluralSingular->setPluralGrammems($pluralGrammems);
        $pluralSingular->setSingularPartOfSpeech($singularPartOfSpeech);
        $pluralSingular->setPluralPartOfSpeech($pluralPartOfSpeech);

        return $pluralSingular;
    }

    private function setNumerals(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('ЧИСЛ') as $paradigm) {
            $this->_numerals[$paradigm->getBaseForm()]['Падежи'] = [
                'Именительный' => $this->setCase($paradigm, "ИМ"),
                'Родительный' => $this->setCase($paradigm, "РД"),
                'Дательный' => $this->setCase($paradigm, "ДТ"),
                'Винительный' => $this->setCase($paradigm, "ВН"),
                'Творительный' => $this->setCase($paradigm, "ТВ"),
                'Предложный' => $this->setCase($paradigm, "ПР")
            ];

            $this->_numerals[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_numerals[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
