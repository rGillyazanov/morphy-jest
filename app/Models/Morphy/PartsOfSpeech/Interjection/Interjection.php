<?php

namespace App\Models\Morphy\PartsOfSpeech\Interjection;

class Interjection extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Междометие
     * @var array
     */
    private array $_interjection;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setInterjection();
    }

    /**
     * @return array
     */
    public function getInterjection(): array
    {
        return $this->_interjection;
    }

    private function setInterjection(): void {
        foreach ($this->_paradigms->getByPartOfSpeech("МЕЖД") as $paradigm) {
            $this->_interjection[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            $partOfSpeech = '';

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    $partOfSpeech = $form->getPartOfSpeech();
                    array_unshift($this->_interjection[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }

            $this->_interjection[$paradigm->getBaseForm()] = [
                'Слово' => $paradigm->getBaseForm(),
                'Граммемы' => $paradigm[0]->getGrammems(),
                'Часть речи' => $partOfSpeech
            ];
        }
    }
}
