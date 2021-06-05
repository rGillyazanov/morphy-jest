<?php

namespace App\Models\Morphy\PartsOfSpeech\GeneralModels;

use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\WordFormsModel;
use App\Models\Morphies\WordGrammems;
use App\Models\Morphy\HelpMorphyService;
use JsonSerializable;

class PluralSingular implements JsonSerializable
{
    private string $_plural;

    private array $_plural_grammems = [];
    private string $_plural_partOfSpeech = '-';

    private string $_singular;

    private array $_singular_grammems = [];
    private string $_singular_partOfSpeech = '-';

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
     * @return array
     */
    public function getPluralGrammems(): array
    {
        sort($this->_plural_grammems);
        return $this->_plural_grammems;
    }

    /**
     * @return array
     */
    public function getSingularGrammems(): array
    {
        sort($this->_singular_grammems);
        return $this->_singular_grammems;
    }

    /**
     * @param array $plural_grammems
     */
    public function setPluralGrammems(array $plural_grammems): void
    {
        $this->_plural_grammems = $plural_grammems;
    }

    /**
     * @param array $singular_grammems
     */
    public function setSingularGrammems(array $singular_grammems): void
    {
        $this->_singular_grammems = $singular_grammems;
    }

    /**
     * @param string $plural_partOfSpeech
     */
    public function setPluralPartOfSpeech(string $plural_partOfSpeech): void
    {
        $this->_plural_partOfSpeech = $plural_partOfSpeech;
    }

    /**
     * @param string $singular_partOfSpeech
     */
    public function setSingularPartOfSpeech(string $singular_partOfSpeech): void
    {
        $this->_singular_partOfSpeech = $singular_partOfSpeech;
    }

    /**
     * @return string
     */
    public function getPluralPartOfSpeech(): string
    {
        return $this->_plural_partOfSpeech;
    }

    /**
     * @return string
     */
    public function getSingularPartOfSpeech(): string
    {
        return $this->_singular_partOfSpeech;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return [
            'ЕД' => [
                'Слово' => $this->_singular,
                'Граммемы' => $this->getSingularGrammems(),
                'Часть речи' => $this->getSingularPartOfSpeech()
            ],
            'МН' => [
                'Слово' => $this->_plural,
                'Граммемы' => $this->getPluralGrammems(),
                'Часть речи' => $this->getPluralPartOfSpeech()
            ],
            'Жесты' => [
                'ЕД' => HelpMorphyService::hasInJests($this->_singular, $this->getSingularGrammems(), $this->getSingularPartOfSpeech()),
                'МН' => HelpMorphyService::hasInJests($this->_plural, $this->getPluralGrammems(), $this->getPluralPartOfSpeech())
            ]
        ];
    }
}
