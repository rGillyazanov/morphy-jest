<?php

namespace App\Models\Morphy\PartsOfSpeech\Adverbs;

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

        $this->setPronouns();
    }

    /**
     * @return array
     */
    public function getAdverb(): array
    {
        return $this->_adverb;
    }

    private function setPronouns(): void {
        foreach ($this->_paradigms->getByPartOfSpeech("Н") as $paradigm) {
            $this->_adverb[$paradigm->getBaseForm()] = [
                $paradigm->getBaseForm()
            ];

            $this->_adverb[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_adverb[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
