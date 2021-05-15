<?php

namespace App\Models\Morphy\PartsOfSpeech\Pretext;

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
        foreach ($this->_paradigms->getByPartOfSpeech("ПРЕДЛ") as $paradigm) {
            $this->_pretext[$paradigm->getBaseForm()] = [
                $paradigm->getBaseForm()
            ];

            $this->_pretext[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_pretext[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
