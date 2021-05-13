<?php

namespace App\Models\Morphy;

use App\Models\Morphy\PartsOfSpeech\Adjectives\Adjective;
use App\Models\Morphy\PartsOfSpeech\Adverbs\Adverb;
use App\Models\Morphy\PartsOfSpeech\Conjunction\Conjunction;
use App\Models\Morphy\PartsOfSpeech\Interjection\Interjection;
use App\Models\Morphy\PartsOfSpeech\Nouns\Noun;
use App\Models\Morphy\PartsOfSpeech\Numerals\Numeral;
use App\Models\Morphy\PartsOfSpeech\Ordinals\Ordinal;
use App\Models\Morphy\PartsOfSpeech\Parenthesis\Parenthesis;
use App\Models\Morphy\PartsOfSpeech\Particle\Particle;
use App\Models\Morphy\PartsOfSpeech\Phrase\Phrase;
use App\Models\Morphy\PartsOfSpeech\Predicatives\Predicative;
use App\Models\Morphy\PartsOfSpeech\Pretext\Pretext;
use App\Models\Morphy\PartsOfSpeech\PronominalAdjectives\PronominalAdjective;
use App\Models\Morphy\PartsOfSpeech\Pronouns\Pronoun;
use App\Models\Morphy\PartsOfSpeech\Verbs\Verb;
use phpMorphy_Exception;
use SEOService2020\Morphy\Morphy;
use phpMorphy_Paradigm_Collection;

class MorphyAnalyzer
{
  private const ERRORS = [
    10001 => 'Can`t find word'
  ];

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
   * @var phpMorphy_Paradigm_Collection|bool
   */
  private $_paradigms;

  /**
   * Все типы речи у слова.
   * @var array
   */
  private array $_typesOfWord;

  /**
   * MorphyAnalyzer constructor.
   * @param string $word
   * @throws phpMorphy_Exception
   */
  public function __construct(string $word)
  {
    $this->morphy = new Morphy(Morphy::russianLang);

    $this->_word = $word;

    $this->_paradigms = $this->morphy->findWord($word);

    if (!$this->_paradigms) {
      throw new phpMorphy_Exception(self::ERRORS[10001], 10001);
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

    if (count($this->_paradigms->getByPartOfSpeech('ИНФИНИТИВ')) > 0) {
      $verb = new Verb($this->_word, $this->_paradigms);
      $typesOfWord['Глаголы'] = $verb->getVerbs();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ЧИСЛ')) > 0) {
      $numeral = new Numeral($this->_word, $this->_paradigms);
      $typesOfWord['Числительные'] = $numeral->getNumerals();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ЧИСЛ-П')) > 0) {
      $ordinal = new Ordinal($this->_word, $this->_paradigms);
      $typesOfWord['Порядковые числительные'] = $ordinal->getOrdinals();
    }

    if (count($this->_paradigms->getByPartOfSpeech('МС')) > 0) {
      $pronoun = new Pronoun($this->_word, $this->_paradigms, 'МС');
      $typesOfWord['Местоимение-существительное'] = $pronoun->getPronouns();
    }

    if (count($this->_paradigms->getByPartOfSpeech('МС-ПРЕДК')) > 0) {
      $pronoun = new Pronoun($this->_word, $this->_paradigms, 'МС-ПРЕДК');
      $typesOfWord['Местоимение-предикатив'] = $pronoun->getPronouns();
    }

    if (count($this->_paradigms->getByPartOfSpeech('МС-П')) > 0) {
      $pronominalAdjective = new PronominalAdjective($this->_word, $this->_paradigms);
      $typesOfWord['Местоименное прилагательное'] = $pronominalAdjective->getPronominalAdjective();
    }

    if (count($this->_paradigms->getByPartOfSpeech('Н')) > 0) {
      $adverb = new Adverb($this->_word, $this->_paradigms);
      $typesOfWord['Наречие'] = $adverb->getAdverb();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ПРЕДК')) > 0) {
      $predicative = new Predicative($this->_word, $this->_paradigms);
      $typesOfWord['Предикатив'] = $predicative->getPredicative();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ПРЕДЛ')) > 0) {
      $pretext = new Pretext($this->_word, $this->_paradigms);
      $typesOfWord['Предлог'] = $pretext->getPretext();
    }

    if (count($this->_paradigms->getByPartOfSpeech('СОЮЗ')) > 0) {
      $conjunction = new Conjunction($this->_word, $this->_paradigms);
      $typesOfWord['Союз'] = $conjunction->getConjunction();
    }

    if (count($this->_paradigms->getByPartOfSpeech('МЕЖД')) > 0) {
      $interjection = new Interjection($this->_word, $this->_paradigms);
      $typesOfWord['Междометие'] = $interjection->getInterjection();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ЧАСТ')) > 0) {
      $particle = new Particle($this->_word, $this->_paradigms);
      $typesOfWord['Частица'] = $particle->getParticle();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ВВОДН')) > 0) {
      $parenthesis = new Parenthesis($this->_word, $this->_paradigms);
      $typesOfWord['Вводное слово'] = $parenthesis->getParenthesis();
    }

    if (count($this->_paradigms->getByPartOfSpeech('ФРАЗ')) > 0) {
      $phrase = new Phrase($this->_word, $this->_paradigms);
      $typesOfWord['Фразеологизм'] = $phrase->getPhrase();
    }

    return $typesOfWord;
  }
}
