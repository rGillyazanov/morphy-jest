<?php

namespace App\Models\Morphy\PartsOfSpeech\Pretext;

use App\Models\Morphy\HelpMorphyService;

class Pretext extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Предлог
     * @var array
     */
    private array $_pretext;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setPretext();
    }

    /**
     * @return array
     */
    public function getPretext(): array
    {
        return $this->_pretext;
    }

    private function setPretext(): void {
        $this->_pretext = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'ПРЕДЛ');
    }
}
