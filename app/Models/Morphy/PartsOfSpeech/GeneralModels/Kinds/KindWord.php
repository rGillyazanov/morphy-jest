<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels\Kinds;

use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\WordFormsModel;
use App\Models\Morphies\WordGrammems;
use App\Models\Morphy\HelpMorphyService;
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
        if (in_array('ОД', $normal_grammems) && in_array('НО', $normal_grammems)) {
            unset($normal_grammems[array_search('НО', $normal_grammems)]);
        }
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
        if (in_array('ОД', $degree_grammems) && in_array('НО', $degree_grammems)) {
            unset($degree_grammems[array_search('НО', $degree_grammems)]);
        }
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
        $normal = [
            'Слово' => $this->getNormal(),
            'Граммемы' => $this->getNormalGrammems(),
            'Часть речи' => $this->getNormalPartOfSpeech()
        ];

        $hasJests = [
            'НОРМ' => HelpMorphyService::hasInJests($this->getNormal(), $this->getNormalGrammems(), $this->getNormalPartOfSpeech()),
        ];

        if (!empty($this->getDegree())) {
            $hasJests['ПРЕВ'] = HelpMorphyService::hasInJests($this->getDegree(), $this->getDegreeGrammems(), $this->getDegreePartOfSpeech());

            return [
                'НОРМ' => $normal,
                'ПРЕВ' => [
                    'Слово' => $this->getDegree(),
                    'Граммемы' => $this->getDegreeGrammems(),
                    'Часть речи' => $this->getDegreePartOfSpeech()
                ],
                'ЖЕСТЫ' => $hasJests
            ];
        }

        return [
            'НОРМ' => $normal,
            'ЖЕСТЫ' => $hasJests
        ];
    }
}
