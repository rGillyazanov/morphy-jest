<?php
namespace App\Models\Morphy\PartsOfSpeech\Nouns;

use phpMorphy_Paradigm_ParadigmInterface;
use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\PluralSingular;

class Noun extends BasePartOfSpeech
{
    /**
     * Существительные
     * @var array
     */
    private array $_nouns;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setNouns();
    }

    /**
     * @return array
     */
    public function getNouns(): array
    {
        return $this->_nouns;
    }

    /**
     * Устанавливает падеж.
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param string $case - падеж
     * @return false|string
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

    private function setNouns(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('С') as $paradigm) {
            $this->_nouns[$paradigm->getBaseForm()]['Падежи'] = [
                'Именительный' => $this->setCase($paradigm, "ИМ"),
                'Родительный' => $this->setCase($paradigm, "РД"),
                'Дательный' => $this->setCase($paradigm, "ДТ"),
                'Винительный' => $this->setCase($paradigm, "ВН"),
                'Творительный' => $this->setCase($paradigm, "ТВ"),
                'Предложный' => $this->setCase($paradigm, "ПР"),
                'Звательный' => $this->setCase($paradigm, "ЗВ")
            ];

            $this->_nouns[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
              if ($paradigm->getBaseForm() === $form->getWord()) {
                array_unshift($this->_nouns[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                break;
              }
            }
        }
    }
}
