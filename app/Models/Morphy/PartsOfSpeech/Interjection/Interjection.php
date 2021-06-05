<?php

namespace App\Models\Morphy\PartsOfSpeech\Interjection;

use App\Models\Morphy\HelpMorphyService;

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
        $this->_interjection = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'МЕЖД');
    }
}
