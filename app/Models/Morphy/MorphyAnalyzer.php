<?php
namespace App\Models\Morphy;

use App\Models\Morphy\PartsOfSpeech\Adjectives\Adjective;
use App\Models\Morphy\PartsOfSpeech\Nouns\Noun;
use phpMorphy_Exception;
use SEOService2020\Morphy\Morphy;
use phpMorphy_Paradigm_Collection;

class MorphyAnalyzer
{
    private Morphy $morphy;

    /**
     * Анализируемое слово.
     * @var string
     */
    private string $_word;

    /**
     * Базовая форма анализируемого слова.
     * @var string
     */
    private string $_baseForm;

    /**
     * Коллекция парадигм анализируемого слова.
     * @var phpMorphy_Paradigm_Collection
     */
    private phpMorphy_Paradigm_Collection $_paradigms;

    /**
     * Все типы речи у слова.
     * @var array
     */
    private array $_typesOfWord;

    public function __construct(string $word)
    {
        $this->morphy = new Morphy(Morphy::russianLang);

        $this->_word = $word;

        $this->_paradigms = $this->morphy->findWord($word);

        if (!$this->_paradigms) {
            throw new phpMorphy_Exception('Слово не найдено в словаре.');
        }

        $this->_typesOfWord = $this->initTypesOfWord();
    }

    /**
     * @return Morphy
     */
    public function getMorphy(): Morphy
    {
        return $this->morphy;
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->_word;
    }

    /**
     * @return string
     */
    public function getBaseForm(): string
    {
        return $this->_baseForm;
    }

    /**
     * @return phpMorphy_Paradigm_Collection
     */
    public function getParadigms(): phpMorphy_Paradigm_Collection
    {
        return $this->_paradigms;
    }

    /**
     * @return int
     */
    public function getCountOfLemmas(): int
    {
        return $this->_paradigms->count();
    }

    /**
     * @return array
     */
    public function getTypesOfWord(): array
    {
        return $this->_typesOfWord;
    }

    private function initTypesOfWord(): array
    {
        $typesOfWord = [];

        if (count($this->_paradigms->getByPartOfSpeech('С')) > 0) {
            $noun = new Noun($this->_word, $this->_paradigms);
            $typesOfWord['Существительные'] = $noun->getNouns();
        }

        if (count($this->_paradigms->getByPartOfSpeech('П')) > 0) {
            $adjective = new Adjective($this->_word, $this->_paradigms);
            $typesOfWord['Прилагательные'] = $adjective->getAdjectives();
        }

        return $typesOfWord;
    }
}
