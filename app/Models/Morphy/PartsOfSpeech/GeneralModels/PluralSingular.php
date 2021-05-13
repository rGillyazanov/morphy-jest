<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels;

use JsonSerializable;

class PluralSingular implements JsonSerializable
{
    private string $_plural;
    private string $_singular;

    public function __construct(string $singular, string $plural)
    {
        $this->_plural = $plural;
        $this->_singular = $singular;
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
     * @return mixed
     */
    public function jsonSerialize()
    {
        return [
            'ЕД' => $this->_singular,
            'МН' => $this->_plural
        ];
    }
}
