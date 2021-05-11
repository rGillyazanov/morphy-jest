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
            $this->_phrase[$paradigm->getBaseForm()] = [
                $paradigm->getBaseForm()
            ];
        }
    }
}
