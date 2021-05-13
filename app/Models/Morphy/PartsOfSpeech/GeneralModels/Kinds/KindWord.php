<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels\Kinds;

use JsonSerializable;

class KindWord implements JsonSerializable
{
    private string $_normal;
    private string $_degree;

    public function __construct(string $normal)
    {
        $this->_normal = $normal;
        $this->_degree = '';
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

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        if (!empty($this->getDegree())) {
            return [
                'НОРМ' => $this->getNormal(),
                'ПРЕВ' => $this->getDegree(),
            ];
        }

        return [
            'НОРМ' => $this->getNormal()
        ];
    }
}
