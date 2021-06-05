<?php

namespace App\Models\Morphy\PartsOfSpeech\Parenthesis;

use App\Models\Morphy\HelpMorphyService;

class Parenthesis extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Вводное слово
     * @var array
     */
    private array $_parenthesis;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setParenthesis();
    }

    /**
     * @return array
     */
    public function getParenthesis(): array
    {
        return $this->_parenthesis;
    }

    private function setParenthesis(): void {
        $this->_parenthesis = HelpMorphyService::setUnchangeableWord($this->_paradigms, 'ВВОДН');
    }
}
