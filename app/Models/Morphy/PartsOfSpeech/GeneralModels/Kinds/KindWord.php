<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels\Kinds;

class KindWord
{
    private string $_normal;
    private string $_degree;

    public function __construct(string $normal)
    {
        $this->_normal = $normal;
    }

    /**
     * @return string
     */
    public function getNormal(): string
    {
        return $this->_normal;
    }

    /**
     * @return string
     */
    public function getDegree(): string
    {
        return $this->_degree;
    }

    public function setDegree($value)
    {
        $this->_degree = $value;
    }
}
