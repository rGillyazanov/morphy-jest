<?php

namespace App\Models\Morphy\PartsOfSpeech\Phrase;

class Phrase extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Фразеологизм
     * @var array
     */
    private array $_phrase;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setPhrase();
    }

    /**
     * @return array
     */
    public function getPhrase(): array
    {
        return $this->_phrase;
    }

    private function setPhrase(): void {
        foreach ($this->_paradigms->getByPartOfSpeech("ФРАЗ") as $paradigm) {
            $this->_phrase[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            $partOfSpeech = '';

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    $partOfSpeech = $form->getPartOfSpeech();
                    array_unshift($this->_phrase[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }

            $this->_phrase[$paradigm->getBaseForm()] = [
                'Слово' => $paradigm->getBaseForm(),
                'Граммемы' => $paradigm[0]->getGrammems(),
                'Часть речи' => $partOfSpeech
            ];
        }
    }
}
