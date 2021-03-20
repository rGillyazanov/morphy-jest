<?php

namespace App\Models\Morphy\PartsOfSpeech\Nouns;

class PluralSingular
{
    private bool $_pluralEqualWithWord;
    private bool $_singularEqualWithWord;

    private string $_plural;
    private string $_singular;

    public function __construct(string $singular, string $plural, bool $pluralEqualWithWord, bool $singularEqualWithWord)
    {
        $this->_plural = $plural;
        $this->_singular = $singular;
        $this->_pluralEqualWithWord = $pluralEqualWithWord;
        $this->_singularEqualWithWord = $singularEqualWithWord;
    }

    /**
     * @return string
     */
    public function getSingular(): string
    {
        return $this->_singular;
    }

    /**
     * @return string
     */
    public function getPlural(): string
    {
        return $this->_plural;
    }

    /**
     * @return bool
     */
    public function isPluralEqualWithWord(): bool
    {
        return $this->_pluralEqualWithWord;
    }

    /**
     * @return bool
     */
    public function isSingularEqualWithWord(): bool
    {
        return $this->_singularEqualWithWord;
    }
}
