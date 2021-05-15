<?php
namespace App\Models\Morphy\PartsOfSpeech\Nouns;

use App\Models\Morphy\MorphyAnalyzer;
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
        $plural = "-";

        if (count($paradigm->getWordFormsByGrammems([$case, 'ЕД'])) > 0) {
            $singular = $paradigm->getWordFormsByGrammems([$case, 'ЕД'])[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems([$case, 'МН'])) > 0) {
            $plural = $paradigm->getWordFormsByGrammems([$case, 'МН'])[0]->getWord();
        }

        return new PluralSingular(
            $singular,
            $plural
        );
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
