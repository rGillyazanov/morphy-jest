<?php

namespace App\Models\Morphy\PartsOfSpeech\Conjunction;

class Conjunction extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Союз
     * @var array
     */
    private array $_conjunction;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setConjunction();
    }

    /**
     * @return array
     */
    public function getConjunction(): array
    {
        return $this->_conjunction;
    }

    private function setConjunction(): void {
        foreach ($this->_paradigms->getByPartOfSpeech("СОЮЗ") as $paradigm) {
            $this->_conjunction[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            $partOfSpeech = '';

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    $partOfSpeech = $form->getPartOfSpeech();
                    array_unshift($this->_conjunction[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }

            $this->_conjunction[$paradigm->getBaseForm()] = [
                'Слово' => $paradigm->getBaseForm(),
                'Граммемы' => $paradigm[0]->getGrammems(),
                'Часть речи' => $partOfSpeech
            ];
        }
    }
}
