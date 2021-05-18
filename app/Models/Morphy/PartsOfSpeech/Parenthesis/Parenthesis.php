<?php

namespace App\Models\Morphy\PartsOfSpeech\Parenthesis;

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
        foreach ($this->_paradigms->getByPartOfSpeech("ВВОДН") as $paradigm) {
            $this->_parenthesis[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            $partOfSpeech = '';

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    $partOfSpeech = $form->getPartOfSpeech();
                    array_unshift($this->_parenthesis[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }

            $this->_parenthesis[$paradigm->getBaseForm()] = [
                'Слово' => $paradigm->getBaseForm(),
                'Граммемы' => $paradigm[0]->getGrammems(),
                'Часть речи' => $partOfSpeech
            ];
        }
    }
}
