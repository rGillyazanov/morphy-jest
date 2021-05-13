<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels;

use App\Models\Morphy\PartsOfSpeech\GeneralModels\Kinds\KindWord;
use JsonSerializable;

class Singular implements JsonSerializable
{
    private KindWord $_masculine;
    private KindWord $_feminine;
    private KindWord $_neuter;

    public function __construct(string $masculine, string $feminine, string $neuter)
    {
        $this->_masculine = new KindWord($masculine);
        $this->_feminine = new KindWord($feminine);
        $this->_neuter = new KindWord($neuter);
    }

    /**
     * @return KindWord
     */
    public function getMasculine(): KindWord
    {
        return $this->_masculine;
    }

    /**
     * @return KindWord
     */
    public function getFeminine(): KindWord
    {
        return $this->_feminine;
    }

    /**
     * @return KindWord
     */
    public function getNeuter(): KindWord
    {
        return $this->_neuter;
    }

    public function jsonSerialize()
    {
        return [
            'МР' => $this->getMasculine(),
            'ЖР' => $this->getFeminine(),
            'СР' => $this->getNeuter(),
        ];
    }
}
