<?php

namespace App\Models\Morphy\PartsOfSpeech\Verbs;

use App\Models\Morphy\HelpMorphyService;
use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;

use App\Models\Morphy\PartsOfSpeech\Nouns\PluralSingular;
use phpMorphy_Paradigm_ParadigmInterface;

class Verb extends BasePartOfSpeech
{
    private array $_verbs;

    private HelpMorphyService $helpMorphyService;

    public function __construct($word, $paradigms)
    {
        parent::__construct($word, $paradigms);

        $this->helpMorphyService = new HelpMorphyService();

        $this->setVerb();
    }

    /**
     * @return array
     */
    public function getVerbs(): array
    {
        return $this->_verbs;
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
        $feminineNormal = "-";
        $neuterNormal = "-";

        $masculineDegree = "-";
        $feminineDegree = "-";
        $neuterDegree = "-";

        $pluralNormal = "-";
        $pluralDegree = "-";

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))) > 0) {
            $masculineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getWord();
        }
        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР', 'ПРЕВ']))) > 0) {
            $masculineDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР', 'ПРЕВ']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getWord();
        }
        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР', 'ПРЕВ']))) > 0) {
            $feminineDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР', 'ПРЕВ']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getWord();
        }
        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР', 'ПРЕВ']))) > 0) {
            $neuterDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР', 'ПРЕВ']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН', 'ПРЕВ']))) > 0) {
            $pluralDegree = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН', 'ПРЕВ']))[0]->getWord();
        }

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine()->setDegree($masculineDegree);
        $singular->getFeminine()->setDegree($feminineDegree);
        $singular->getNeuter()->setDegree($neuterDegree);

        $plural = new Plural($pluralNormal);

        $plural->getKind()->setDegree($pluralDegree);

        return new CaseWord($singular, $plural);
    }

    /**
     * Устанавливает настоящее время
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @return PluralSingular[]
     */
    private function setPresentTime(phpMorphy_Paradigm_ParadigmInterface $paradigm): array
    {
        return [
            1 => new PluralSingular(
                $this->helpMorphyService->getWordByGrammars($paradigm, ['1Л', 'ЕД', 'НСТ']),
                $this->helpMorphyService->getWordByGrammars($paradigm, ['1Л', 'МН', 'НСТ']),
            ),
            2 => new PluralSingular(
                $this->helpMorphyService->getWordByGrammars($paradigm, ['2Л', 'ЕД', 'НСТ']),
                $this->helpMorphyService->getWordByGrammars($paradigm, ['2Л', 'МН', 'НСТ'])
            ),
            3 => new PluralSingular(
                $this->helpMorphyService->getWordByGrammars($paradigm, ['3Л', 'ЕД', 'НСТ']),
                $this->helpMorphyService->getWordByGrammars($paradigm, ['3Л', 'МН', 'НСТ'])
            )
        ];
    }

    /**
     * Устанавливает прошедшее время
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @return CaseWord
     */
    private function setPastTime(phpMorphy_Paradigm_ParadigmInterface $paradigm): CaseWord
    {
        $plural = new Plural(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'МН'])
        );
        $singular = new Singular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'МР', 'ЕД']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'ЖР', 'ЕД']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПРШ', 'СР', 'ЕД']),
        );

        return new CaseWord($singular, $plural);
    }

    /**
     * Устанавливает повелительное наклонение
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @return PluralSingular
     */
    private function setImperativeMood(phpMorphy_Paradigm_ParadigmInterface $paradigm): PluralSingular
    {
        return new PluralSingular();
    }

    /**
     * Устанавливает таблицу с падежами определенной грамматики
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param $grammer
     * @return array
     */
    private function setTableWithCases(phpMorphy_Paradigm_ParadigmInterface $paradigm, $grammer)
    {
        $grammer = '';

        return [
            'Именительный' => $this->setCase($paradigm, ["ИМ"]),
            'Родительный' => $this->setCase($paradigm, ["РД"]),
            'Дательный' => $this->setCase($paradigm, ["ДТ"]),
            'Винительный (Одушевленный)' => $this->setCase($paradigm, ["ВН", "ОД"]),
            'Винительный (Неодушевленный)' => $this->setCase($paradigm, ["ВН", "НО"]),
            'Творительный' => $this->setCase($paradigm, ["ТВ"]),
            'Предложный' => $this->setCase($paradigm, ["ПР"]),
            'Краткое причастие' => '',
        ];
    }

    private function setVerb(): void
    {
        foreach ($this->_paradigms->getByPartOfSpeech('ИНФИНИТИВ') as $paradigm) {
            $this->_verbs[$paradigm->getBaseForm()] = [
                'Время' => [
                    'Настоящее' => $this->setPresentTime($paradigm),
                    'Прошедшее' => $this->setPastTime($paradigm)
                ],
                'Повелительное наклонение' => [],
                'Деепричастие' => [],
                'Причастие' => [
                    'Настоящее время' => [
                        'Действительный залог' => '',
                        'Страдательный залог' => ''
                    ],
                    'Прошедшее время' => [
                        'Действительный залог' => '',
                        'Страдательный залог' => ''
                    ]
                ]
            ];
        }

        dd($this->_verbs);
    }
}
