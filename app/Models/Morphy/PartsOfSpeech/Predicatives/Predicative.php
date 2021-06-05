<?php

namespace App\Models\Morphy\PartsOfSpeech\Predicatives;

use App\Models\Morphy\HelpMorphyService;

class Predicative extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Предикатив
     * @var array
     */
    private array $_predicative;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setPredicative();
    }

    /**
     * @return array
     */
    public function getPredicative(): array
    {
        return $this->_predicative;
    }

    private function setPredicative(): void {
        $this->_predicative = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'ПРЕДК');
    }
}
