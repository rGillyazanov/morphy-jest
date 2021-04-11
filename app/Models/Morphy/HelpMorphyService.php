<?php

namespace App\Models\Morphy;

use phpMorphy_Paradigm_ParadigmInterface;

class HelpMorphyService
{

    public function getWordByGrammars(phpMorphy_Paradigm_ParadigmInterface $paradigm, $grammars)
    {
        $word = $paradigm->getWordFormsByGrammems($grammars);

        return count($word) > 0 ? $word[0]->getWord() : '-';
    }
}
