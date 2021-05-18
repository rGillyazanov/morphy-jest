<?php

namespace App\Models\Morphy\PartsOfSpeech\Adjectives;

use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;
use phpMorphy_Paradigm_ParadigmInterface;

class Adjective extends BasePartOfSpeech
{
    /**
     * Прилагательные
     * @var array
     */
    private array $_adjectives;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->setAdjective();
    }

    /**
     * @return array
     */
    public function getAdjectives(): array
    {
        return $this->_adjectives;
    }

    /**
     * Устанавливает падеж.
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param array $case - падеж
     * @return CaseWord
     */
    private function setCase(phpMorphy_Paradigm_ParadigmInterface $paradigm, array $case): CaseWord
    {
        $masculineNormal = "-";
        $masculineNormalGrammems = [];
        $masculineNormalPartOfSpeech = "-";

        $feminineNormal = "-";
        $feminineNormalGrammems = [];
        $feminineNormalPartOfSpeech = "-";

        $neuterNormal = "-";
        $neuterNormalGrammems = [];
        $neuterNormalPartOfSpeech = "-";

        $masculineDegree = "-";
        $masculineDegreeGrammems = [];
        $masculineDegreePartOfSpeech = "-";

        $feminineDegree = "-";
        $feminineDegreeGrammems = [];
        $feminineDegreePartOfSpeech = "-";

        $neuterDegree = "-";
        $neuterDegreeGrammems = [];
        $neuterDegreePartOfSpeech = "-";

        $pluralNormal = "-";
        $pluralNormalGrammems = [];
        $pluralNormalPartOfSpeech = "-";

        $pluralDegree = "-";
        $pluralDegreeGrammems = [];
        $pluralDegreePartOfSpeech = "-";

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))) > 0) {
            $masculineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getWord();
            $masculineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getPartOfSpeech();
            $masculineNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getGrammems();
        }
        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР', 'ПРЕВ']))) > 0) {
            $masculineDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР', 'ПРЕВ']))[0]->getWord();
            $masculineDegreePartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР', 'ПРЕВ']))[0]->getPartOfSpeech();
            $masculineDegreeGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР', 'ПРЕВ']))[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getWord();
            $feminineNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getPartOfSpeech();
            $feminineNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getGrammems();
        }
        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР', 'ПРЕВ']))) > 0) {
            $feminineDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР', 'ПРЕВ']))[0]->getWord();
            $feminineDegreePartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР', 'ПРЕВ']))[0]->getPartOfSpeech();
            $feminineDegreeGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР', 'ПРЕВ']))[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getWord();
            $neuterNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getPartOfSpeech();
            $neuterNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getGrammems();
        }
        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР', 'ПРЕВ']))) > 0) {
            $neuterDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР', 'ПРЕВ']))[0]->getWord();
            $neuterDegreePartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР', 'ПРЕВ']))[0]->getPartOfSpeech();
            $neuterDegreeGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР', 'ПРЕВ']))[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getWord();
            $pluralNormalPartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getPartOfSpeech();
            $pluralNormalGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getGrammems();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН', 'ПРЕВ']))) > 0) {
            $pluralDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН', 'ПРЕВ']))[0]->getWord();
            $pluralDegreePartOfSpeech = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН', 'ПРЕВ']))[0]->getPartOfSpeech();
            $pluralDegreeGrammems = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН', 'ПРЕВ']))[0]->getGrammems();
        }

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine()->setNormalGrammems($masculineNormalGrammems);
        $singular->getMasculine()->setNormalPartOfSpeech($masculineNormalPartOfSpeech);
        $singular->getMasculine()->setDegree($masculineDegree);
        $singular->getMasculine()->setDegreeGrammems($masculineDegreeGrammems);
        $singular->getMasculine()->setDegreePartOfSpeech($masculineDegreePartOfSpeech);

        $singular->getFeminine()->setNormalGrammems($feminineNormalGrammems);
        $singular->getFeminine()->setNormalPartOfSpeech($feminineNormalPartOfSpeech);
        $singular->getFeminine()->setDegree($feminineDegree);
        $singular->getFeminine()->setDegreeGrammems($feminineDegreeGrammems);
        $singular->getFeminine()->setDegreePartOfSpeech($feminineDegreePartOfSpeech);

        $singular->getNeuter()->setNormalGrammems($neuterNormalGrammems);
        $singular->getNeuter()->setNormalPartOfSpeech($neuterNormalPartOfSpeech);
        $singular->getNeuter()->setDegree($neuterDegree);
        $singular->getNeuter()->setDegreeGrammems($neuterDegreeGrammems);
        $singular->getNeuter()->setDegreePartOfSpeech($neuterDegreePartOfSpeech);

        $plural = new Plural($pluralNormal);

        $plural->getKind()->setNormalGrammems($pluralNormalGrammems);
        $plural->getKind()->setNormalPartOfSpeech($pluralNormalPartOfSpeech);
        $plural->getKind()->setDegree($pluralDegree);
        $plural->getKind()->setDegreeGrammems($pluralDegreeGrammems);
        $plural->getKind()->setDegreePartOfSpeech($pluralDegreePartOfSpeech);

        return new CaseWord($singular, $plural);
    }

    /**
     * Устанавливает сравнительную степень прилагательных в массив.
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param array $case
     * @return array
     */
    private function setComparative(phpMorphy_Paradigm_ParadigmInterface $paradigm, array $case): array
    {
        $comparativeWords = [];

        foreach ($paradigm->getWordFormsByGrammems($case) as $form) {
            array_push($comparativeWords, $form->getWord());
        }

        return $comparativeWords;
    }

    private function setAdjective(): void {
        foreach ($this->_paradigms->getByPartOfSpeech('П') as $paradigm) {
            $this->_adjectives[$paradigm->getBaseForm()]['Падежи'] = [
                'Именительный' => $this->setCase($paradigm, ["ИМ"]),
                'Родительный' => $this->setCase($paradigm, ["РД"]),
                'Дательный' => $this->setCase($paradigm, ["ДТ"]),
                'Винительный (Одушевленный)' => $this->setCase($paradigm, ["ВН", "ОД"]),
                'Винительный (Неодушевленный)' => $this->setCase($paradigm, ["ВН", "НО"]),
                'Творительный' => $this->setCase($paradigm, ["ТВ"]),
                'Предложный' => $this->setCase($paradigm, ["ПР"]),
                'Сравнительная степень' => $this->setComparative($paradigm, ["СРАВН"]),
            ];

            $this->_adjectives[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    array_unshift($this->_adjectives[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }
        }

        foreach ($this->_paradigms->getByPartOfSpeech('КР_ПРИЛ') as $paradigm) {
            if (count($paradigm->getWordFormsByPartOfSpeech('КР_ПРИЛ')) > 0) {

                $masculineNormal = "-";
                $feminineNormal = "-";
                $neuterNormal = "-";
                $pluralNormal = "-";

                foreach ($paradigm->getWordFormsByPartOfSpeech('КР_ПРИЛ') as $form) {
                    if ($form->hasGrammems(['ЕД', 'МР', 'КАЧ'])) {
                        $masculineNormal = $form->getWord();
                    }
                    if ($form->hasGrammems(['ЕД', 'ЖР', 'КАЧ'])) {
                        $feminineNormal = $form->getWord();
                    }
                    if ($form->hasGrammems(['ЕД', 'СР', 'КАЧ'])) {
                        $neuterNormal = $form->getWord();
                    }
                    if ($form->hasGrammems(['МН', 'КАЧ'])) {
                        $pluralNormal = $form->getWord();
                    }
                }

                $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);
                $plural = new Plural($pluralNormal);

                $this->_adjectives[$paradigm->getBaseForm()]['Падежи']['Краткое прилагательное'] = new CaseWord($singular, $plural);
            }
        }
    }
}
