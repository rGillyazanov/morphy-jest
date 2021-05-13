<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels;

use JsonSerializable;

class CaseWord implements JsonSerializable
{
    private Singular $_singular;
    private Plural $_plural;

    public function __construct($singular, $plural)
    {
        $this->_singular = $singular;
        $this->_plural = $plural;
    }

    /**
     * @return Singular
     */
    public function getSingular(): Singular
    {
        return $this->_singular;
    }

    /**
     * @return Plural
     */
    public function getPlural(): Plural
    {
        return $this->_plural;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return [
            'ЕД' => $this->getSingular(),
            'МН' => $this->getPlural(),
        ];
    }
}
