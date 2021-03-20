<?php

namespace App\Models\Morphy\PartsOfSpeech;

use phpMorphy_Paradigm_Collection;

class BasePartOfSpeech
{
    protected string $_word;
    protected phpMorphy_Paradigm_Collection $_paradigms;

    public function __construct($word, $paradigms)
    {
        $this->_word = $word;
        $this->_paradigms = $paradigms;
    }
}
