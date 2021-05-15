<?php

namespace App\Models\Morphy\PartsOfSpeech\Particle;

class Particle extends \App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech
{
    /**
     * Частица
     * @var array
     */
    private array $_particle;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setParticle();
    }

    /**
     * @return array
     */
    public function getParticle(): array
    {
        return $this->_particle;
    }

    private function setParticle(): void {
        foreach ($this->_paradigms->getByPartOfSpeech("ЧАСТ") as $paradigm) {
            $this->_particle[$paradigm->getBaseForm()] = [
                $paradigm->getBaseForm()
            ];

            $this->_particle[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_particle[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }
    }
}
