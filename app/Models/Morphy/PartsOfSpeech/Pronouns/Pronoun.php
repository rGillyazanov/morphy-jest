<?php

namespace App\Models\Morphy\PartsOfSpeech\Pronouns;

use phpMorphy_Paradigm_ParadigmInterface;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\PluralSingular;

class Pronoun extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Местоимение-существительное
     * @var array
     */
    private array $_pronouns;

    private string $_type;

    public function __construct($word, $paradigms, $type)
    {
        parent::__construct($word, $paradigms);

        $this->_type = $type;
        $this->setPronouns();
    }

    /**
     * @return array
     */
    public function getPronouns(): array
    {
        return $this->_pronouns;
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

        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД'])) > 0) {
            $singular = $paradigm->getWordFormsByGrammems([$case, 'ЕД'])[0]->getWord();
            $singularPartOfSpeech = $paradigm->getWordFormsByGrammems([$case, 'ЕД'])[0]->getPartOfSpeech();
            $singularGrammems = $paradigm->getWordFormsByGrammems([$case, 'ЕД'])[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems([$case, 'МН'])) > 0) {
            $plural = $paradigm->getWordFormsByGrammems([$case, 'МН'])[0]->getWord();
            $pluralPartOfSpeech = $paradigm->getWordFormsByGrammems([$case, 'МН'])[0]->getPartOfSpeech();
            $pluralGrammems = $paradigm->getWordFormsByGrammems([$case, 'МН'])[0]->getGrammems();
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

    private function setPronouns(): void {
        foreach ($this->_paradigms->getByPartOfSpeech($this->_type) as $paradigm) {
            $this->_pronouns[$paradigm->getBaseForm()]['Падежи'] = [
                'Именительный' => $this->setCase($paradigm, "ИМ"),
                'Родительный' => $this->setCase($paradigm, "РД"),
                'Дательный' => $this->setCase($paradigm, "ДТ"),
                'Винительный' => $this->setCase($paradigm, "ВН"),
                'Творительный' => $this->setCase($paradigm, "ТВ"),
                'Предложный' => $this->setCase($paradigm, "ПР")
            ];

            $this->_pronouns[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_pronouns[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
