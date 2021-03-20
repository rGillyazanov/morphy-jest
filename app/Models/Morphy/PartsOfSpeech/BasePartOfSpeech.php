<?php

namespace App\Models\Morphy\PartsOfSpeech;

use Illuminate\Support\Str;
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

    protected function EqualWithWord(string $formOfParadigm): bool
    {
        return Str::lower($formOfParadigm) === Str::lower($this->_word);
    }
}
