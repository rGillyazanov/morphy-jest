<?php

namespace App\Models\Morphy\PartsOfSpeech\Phrase;

use App\Models\Morphy\HelpMorphyService;

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
        $this->_phrase = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'ФРАЗ');
    }
}
