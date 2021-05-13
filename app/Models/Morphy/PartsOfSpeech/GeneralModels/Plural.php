<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels;

use App\Models\Morphy\PartsOfSpeech\GeneralModels\Kinds\KindWord;
use JsonSerializable;

class Plural implements JsonSerializable
{
    private KindWord $_kind;

    public function __construct($pluralNormal)
    {
        $this->_kind = new KindWord($pluralNormal);
    }

    /**
     * @return KindWord
     */
    public function getKind(): KindWord
    {
        return $this->_kind;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return $this->getKind()->jsonSerialize();
    }
}
