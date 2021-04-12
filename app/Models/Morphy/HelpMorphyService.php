<?php

namespace App\Models\Morphy;

use phpMorphy_Paradigm_Collection;
use phpMorphy_Paradigm_ParadigmInterface;

class HelpMorphyService
{
    public function getWordByGrammars(phpMorphy_Paradigm_ParadigmInterface $paradigm, $grammems)
    {
        $word = $paradigm->getWordFormsByGrammems($grammems);

        return count($word) > 0 ? $word[0]->getWord() : '-';
    }

    public function getWordByGrammarsAndPartOfSpeech(phpMorphy_Paradigm_Collection $paradigms, $partOfSpeech, $grammems)
    {
        foreach ($paradigms->getByPartOfSpeech($partOfSpeech) as $paradigm) {

            foreach ($paradigm->getWordFormsByPartOfSpeech($partOfSpeech) as $form) {
                if ($form->hasGrammems($grammems)) {
                    return $form->getWord();
                }
            }
        }

        return '-';
    }
}
