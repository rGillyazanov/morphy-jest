<?php

namespace App\Models\Morphy\PartsOfSpeech\Verbs;

use App\Models\Morphy\HelpMorphyService;
use App\Models\Morphy\PartsOfSpeech\BasePartOfSpeech;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\CaseWord;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Plural;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\Singular;

use phpMorphy_Paradigm_ParadigmInterface;
use App\Models\Morphy\PartsOfSpeech\GeneralModels\PluralSingular;

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
        $pluralNormal = "-";

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))) > 0) {
            $masculineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'МР']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))) > 0) {
            $feminineNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'ЖР']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))) > 0) {
            $neuterNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['ЕД', 'СР']))[0]->getWord();
        }

        if (count($paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))) > 0) {
            $pluralNormal = $paradigm->getWordFormsByGrammems(array_merge($case, ['МН']))[0]->getWord();
        }

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine();
        $singular->getFeminine();
        $singular->getNeuter();

        $plural = new Plural($pluralNormal);

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
        return new PluralSingular(
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПВЛ', 'ЕД']),
            $this->helpMorphyService->getWordByGrammars($paradigm, ['ПВЛ', 'МН', '2Л'])
        );
    }

    /**
     * Устанавливает таблицу с падежами определенной грамматики
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param array $grammems
     * @return array
     */
    private function setTableWithCases(phpMorphy_Paradigm_ParadigmInterface $paradigm, $grammems = [])
    {
        $im = ['ИМ'];
        $rd = ['РД'];
        $dt = ['ДТ'];
        $vnOd = ['ВН', 'ОД'];
        $vnNo = ['ВН', 'НО'];
        $tv = ['ТВ'];
        $pr = ['ПР'];

        $masculineNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'МР']));
        $feminineNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'ЖР']));
        $neuterNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['ЕД', 'СР']));
        $pluralNormal = $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech($this->_paradigms, 'КР_ПРИЧАСТИЕ', array_merge($grammems, ['МН']));

        $singular = new Singular($masculineNormal, $feminineNormal, $neuterNormal);

        $singular->getMasculine();
        $singular->getFeminine();
        $singular->getNeuter();

        $plural = new Plural($pluralNormal);

        $caseWord = new CaseWord($singular, $plural);

        return [
            'Именительный' => $this->setCase($paradigm, array_merge($grammems, $im)),
            'Родительный' => $this->setCase($paradigm, array_merge($grammems, $rd)),
            'Дательный' => $this->setCase($paradigm, array_merge($grammems, $dt)),
            'Винительный (Одушевленный)' => $this->setCase($paradigm, array_merge($grammems, $vnOd)),
            'Винительный (Неодушевленный)' => $this->setCase($paradigm, array_merge($grammems, $vnNo)),
            'Творительный' => $this->setCase($paradigm, array_merge($grammems, $tv)),
            'Предложный' => $this->setCase($paradigm, array_merge($grammems, $pr)),
            'Краткое причастие' => $caseWord
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
                'Повелительное наклонение' => $this->setImperativeMood($paradigm),
                'Деепричастие' => [
                    'Настоящее' => $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech(
                        $this->_paradigms,
                        'ДЕЕПРИЧАСТИЕ',
                        ['НСТ']
                    ),
                    'Прошедшее' => $this->helpMorphyService->getWordByGrammarsAndPartOfSpeech(
                        $this->_paradigms,
                        'ДЕЕПРИЧАСТИЕ',
                        ['ПРШ']
                    )
                ],
                'Причастие' => [
                    'Настоящее время' => [
                        'Действительный залог' => $this->setTableWithCases($paradigm, ['ДСТ', 'НСТ']),
                        'Страдательный залог' => $this->setTableWithCases($paradigm, ['СТР', 'НСТ'])
                    ],
                    'Прошедшее время' => [
                        'Действительный залог' => $this->setTableWithCases($paradigm, ['ДСТ', 'ПРШ']),
                        'Страдательный залог' => $this->setTableWithCases($paradigm, ['СТР', 'ПРШ'])
                    ]
                ]
            ];
        }
    }
}
