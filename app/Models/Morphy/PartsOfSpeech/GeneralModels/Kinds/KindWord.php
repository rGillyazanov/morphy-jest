<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels\Kinds;

use JsonSerializable;

class KindWord implements JsonSerializable
{
    private string $_normal;
    private array $_normal_grammems = [];
    private string $_normal_partOfSpeech = '';

    private string $_degree;
    private array $_degree_grammems = [];
    private string $_degree_partOfSpeech = '';

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
     * @return array
     */
    public function getNormalGrammems(): array
    {
        sort($this->_normal_grammems);
        return $this->_normal_grammems;
    }

    /**
     * @return string
     */
    public function getNormalPartOfSpeech(): string
    {
        return $this->_normal_partOfSpeech;
    }

    /**
     * @param array $normal_grammems
     */
    public function setNormalGrammems(array $normal_grammems): void
    {
        $this->_normal_grammems = $normal_grammems;
    }

    /**
     * @param string $normal_partOfSpeech
     */
    public function setNormalPartOfSpeech(string $normal_partOfSpeech): void
    {
        $this->_normal_partOfSpeech = $normal_partOfSpeech;
    }

    /**
     * @return array
     */
    public function getDegreeGrammems(): array
    {
        sort($this->_degree_grammems);
        return $this->_degree_grammems;
    }

    /**
     * @return string
     */
    public function getDegreePartOfSpeech(): string
    {
        return $this->_degree_partOfSpeech;
    }

    /**
     * @param array $degree_grammems
     */
    public function setDegreeGrammems(array $degree_grammems): void
    {
        $this->_degree_grammems = $degree_grammems;
    }

    /**
     * @param string $degree_partOfSpeech
     */
    public function setDegreePartOfSpeech(string $degree_partOfSpeech): void
    {
        $this->_degree_partOfSpeech = $degree_partOfSpeech;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        if (!empty($this->getDegree())) {
            return [
                'НОРМ' => [
                    'Слово' => $this->getNormal(),
                    'Граммемы' => $this->getNormalGrammems(),
                    'Часть речи' => $this->getNormalPartOfSpeech()
                ],
                'ПРЕВ' => [
                    'Слово' => $this->getDegree(),
                    'Граммемы' => $this->getDegreeGrammems(),
                    'Часть речи' => $this->getDegreePartOfSpeech()
                ],
            ];
        }

        return [
            'НОРМ' => [
                'Слово' => $this->getNormal(),
                'Граммемы' => $this->getNormalGrammems(),
                'Часть речи' => $this->getNormalPartOfSpeech()
            ]
        ];
    }
}
