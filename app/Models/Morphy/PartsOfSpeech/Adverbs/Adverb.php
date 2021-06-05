<?php

namespace App\Models\Morphy\PartsOfSpeech\Adverbs;

use App\Models\Morphy\HelpMorphyService;

class Adverb extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Наречие
     * @var array
     */
    private array $_adverb;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setAdverb();
    }

    /**
     * @return array
     */
    public function getAdverb(): array
    {
        return $this->_adverb;
    }

    private function setAdverb(): void {
        $this->_adverb = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'Н');
    }
}
