<?php

namespace App\Models\Morphy\PartsOfSpeech\Conjunction;

use App\Models\Morphy\HelpMorphyService;

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
        $this->_conjunction = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'СОЮЗ');
    }
}
