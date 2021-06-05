<?php

namespace App\Models\Morphy;

use App\Models\Morphies\CaseModel;
use App\Models\Morphies\Enthusiasm;
use App\Models\Morphies\Face;
use App\Models\Morphies\Gender;
use App\Models\Morphies\Number;
use App\Models\Morphies\Other;
use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\Pledge;
use App\Models\Morphies\SemanticFeature;
use App\Models\Morphies\Time;
use App\Models\Morphies\Transitivity;
use App\Models\Morphies\View;
use App\Models\Morphies\WordFormsModel;
use App\Models\Morphies\WordGrammems;
use phpMorphy_Paradigm_Collection;
use phpMorphy_Paradigm_ParadigmInterface;
use SEOService2020\Morphy\Morphy;

class HelpMorphyService
{
    private static array $_descriptors = [
        'с' => [
            'description' => 'существительное',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'п' => [
            'description' => 'прилагательное',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'кр_прил' => [
            'description' => 'краткое прилагательное',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'инфинитив' => [
            'description' => 'инфинитив',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'г' => [
            'description' => 'глагол в личной форме',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'деепричастие' => [
            'description' => 'деепричастие',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'причастие' => [
            'description' => 'причастие',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'кр_причастие' => [
            'description' => 'краткое причастие',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'числ' => [
            'description' => 'числительное (количественное)',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'числ-п' => [
            'description' => 'порядковое числительное',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'мс' => [
            'description' => 'местоимение-существительное',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'мс-предк' => [
            'description' => 'местоимение-предикатив',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'мс-п' => [
            'description' => 'местоименное прилагательное',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'н' => [
            'description' => 'наречие',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'предк' => [
            'description' => 'предикатив',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'предл' => [
            'description' => 'предлог',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'союз' => [
            'description' => 'союз',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'межд' => [
            'description' => 'междометие',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'част' => [
            'description' => 'частица',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'вводн' => [
            'description' => 'вводное слово',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'фраз' => [
            'description' => 'фразеологизм',
            'model' => PartOfSpeech::class,
            'word_grammems_id' => 'part_of_speech_id'
        ],
        'мр' => [
            'description' => 'мужской род',
            'model' => Gender::class,
            'word_grammems_id' => 'gender_id'
        ],
        'жр' => [
            'description' => 'женский род',
            'model' => Gender::class,
            'word_grammems_id' => 'gender_id'
        ],
        'ср' => [
            'description' => 'средний род',
            'model' => Gender::class,
            'word_grammems_id' => 'gender_id'
        ],
        'мр-жр' => [
            'description' => 'общий род',
            'model' => Gender::class,
            'word_grammems_id' => 'gender_id'
        ],
        'ед' => [
            'description' => 'единственное число',
            'model' => Number::class,
            'word_grammems_id' => 'number_id'
        ],
        'мн' => [
            'description' => 'множественное число',
            'model' => Number::class,
            'word_grammems_id' => 'number_id'
        ],
        'им' => [
            'description' => 'именительный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'рд' => [
            'description' => 'родительный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'дт' => [
            'description' => 'дательный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'вн' => [
            'description' => 'винительный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'тв' => [
            'description' => 'творительный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'пр' => [
            'description' => 'предложный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'зв' => [
            'description' => 'звательный',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        '2' => [
            'description' => 'второй родительный или второй предложный падежи',
            'model' => CaseModel::class,
            'word_grammems_id' => 'case_id'
        ],
        'нст' => [
            'description' => 'настоящее время',
            'model' => Time::class,
            'word_grammems_id' => 'time_id'
        ],
        'буд' => [
            'description' => 'будущее время',
            'model' => Time::class,
            'word_grammems_id' => 'time_id'
        ],
        'прш' => [
            'description' => 'прошедшее время',
            'model' => Time::class,
            'word_grammems_id' => 'time_id'
        ],
        '1л' => [
            'description' => 'первое лицо',
            'model' => Face::class,
            'word_grammems_id' => 'face_id'
        ],
        '2л' => [
            'description' => 'второе лицо',
            'model' => Face::class,
            'word_grammems_id' => 'face_id'
        ],
        '3л' => [
            'description' => 'третье лицо',
            'model' => Face::class,
            'word_grammems_id' => 'face_id'
        ],
        'од' => [
            'description' => 'одушевленное',
            'model' => Enthusiasm::class,
            'word_grammems_id' => 'enthusiasm_id'
        ],
        'но' => [
            'description' => 'неодушевленное',
            'model' => Enthusiasm::class,
            'word_grammems_id' => 'enthusiasm_id'
        ],
        'св' => [
            'description' => 'совершенный вид',
            'model' => View::class,
            'word_grammems_id' => 'view_id'
        ],
        'нс' => [
            'description' => 'несовершенный вид',
            'model' => View::class,
            'word_grammems_id' => 'view_id'
        ],
        'нп' => [
            'description' => 'переходный',
            'model' => Transitivity::class,
            'word_grammems_id' => 'transitivity_id'
        ],
        'пе' => [
            'description' => 'непереходный',
            'model' => Transitivity::class,
            'word_grammems_id' => 'transitivity_id'
        ],
        'дст' => [
            'description' => 'действительный залог',
            'model' => Pledge::class,
            'word_grammems_id' => 'pledge_id'
        ],
        'стр' => [
            'description' => 'страдательный залог',
            'model' => Pledge::class,
            'word_grammems_id' => 'pledge_id'
        ],
        '0' => [
            'description' => 'неизменяемое',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'безл' => [
            'description' => 'безличный глагол',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'пвл' => [
            'description' => 'повелительное наклонение (императив)',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'притяж' => [
            'description' => 'притяжательное',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'прев' => [
            'description' => 'превосходная степень (для прилагательных)',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'сравн' => [
            'description' => 'сравнительная степень (для прилагательных)',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'кач' => [
            'description' => 'качественное прилагательное',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'дфст' => [
            'description' => '??? прилагательное (не используется)',
            'model' => Other::class,
            'word_grammems_id' => 'other_id'
        ],
        'имя' => [
            'description' => 'имя',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'фам' => [
            'description' => 'фамилия',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'отч' => [
            'description' => 'отчество',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'лок' => [
            'description' => 'топоним',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'аббр' => [
            'description' => 'аббревиатура',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'орг' => [
            'description' => 'организация',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'вопр' => [
            'description' => 'вопросительное наречие',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'указат' => [
            'description' => 'указательное наречие',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'жарг' => [
            'description' => 'жаргонизм',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'разг' => [
            'description' => 'разговорный',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'арх' => [
            'description' => 'архаизм',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'опч' => [
            'description' => 'опечатка',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'поэт' => [
            'description' => 'поэтическое',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'проф' => [
            'description' => 'профессионализм',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ],
        'полож' => [
            'description' => '??? (не используется)',
            'model' => SemanticFeature::class,
            'word_grammems_id' => 'semantic_feature_id'
        ]
    ];

    /**
     * @return array|string[]
     */
    public static function getDescriptors()
    {
        return self::$_descriptors;
    }

    public function getWordByGrammars(phpMorphy_Paradigm_ParadigmInterface $paradigm, $grammems)
    {
        $word = $paradigm->getWordFormsByGrammems($grammems);

        return count($word) > 0 ? $word[0]->getWord() : '-';
    }

    public function getWordByGrammarsAndPartOfSpeech(phpMorphy_Paradigm_Collection $paradigms, $partOfSpeech, $grammems, $type = 'word')
    {
        foreach ($paradigms->getByPartOfSpeech($partOfSpeech) as $paradigm) {
            foreach ($paradigm->getWordFormsByPartOfSpeech($partOfSpeech) as $form) {
                if ($form->hasGrammems($grammems) && $type === 'word') {
                    return $form->getWord();
                } else if ($form->hasGrammems($grammems) && $type === 'grammems') {
                    $grammemsSorted = $form->getGrammems();
                    sort($grammemsSorted);

                    return $grammemsSorted;
                } else if ($form->hasGrammems($grammems) && $type === 'partOfSpeech') {
                    return $form->getPartOfSpeech();
                }
            }
        }

        return '-';
    }

    /**
     * Проверяет привязана ли словоформа к жесту
     * @param $word
     * @param $grammems
     * @param $partOfSpeech
     * @return bool
     */
    public static function hasInJests($word, $grammems, $partOfSpeech)
    {
        $word = WordFormsModel::query()->where('word', mb_strtolower($word, 'UTF-8'))->first();

        if ($word) {
            $partOfSpeechId = PartOfSpeech::query()->firstWhere('descriptor', mb_strtoupper($partOfSpeech, 'UTF-8'));

            if ($partOfSpeechId) {
                $partOfSpeechId = $partOfSpeechId->id;
            }

            $attributes = [];
            $attributes['word_id'] = $word->id;
            $attributes['part_of_speech_id'] = $partOfSpeechId;

            foreach ($grammems as $grammem) {
                foreach (HelpMorphyService::getDescriptors() as $descriptor => $item) {
                    $grammem = mb_strtolower($grammem, 'UTF-8');
                    if ($grammem === $descriptor) {

                        $model = new $item['model']();

                        $idGrammema = $model::query()->where('grammema', $grammem)->first()->id;

                        $attributes[$item['word_grammems_id']] = $idGrammema;
                    }
                }
            }

            $wordGrammem = WordGrammems::query()->firstWhere(
                $attributes
            );

            if ($wordGrammem) {
                $hasJest = $wordGrammem->jests()->exists() ? true : false;

                if ($hasJest) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Возврашает информацию о неизменяемом слове.
     * @param $paradigms
     * @param $partOfSpeech
     * @return array
     */
    public static function setUnchangeableWord($paradigms, $partOfSpeech)
    {
        $resultArray = [];

        foreach ($paradigms->getByPartOfSpeech($partOfSpeech) as $paradigm) {
            $resultArray[$paradigm->getBaseForm()]['Граммемы'] = $paradigm[0]->getGrammems();

            $partOfSpeech = '';

            foreach ($paradigm as $form) {
                if ($paradigm->getBaseForm() === $form->getWord()) {
                    $partOfSpeech = $form->getPartOfSpeech();
                    array_unshift($resultArray[$paradigm->getBaseForm()]['Граммемы'], $form->getPartOfSpeech());
                    break;
                }
            }

            $resultArray[$paradigm->getBaseForm()] = [
                'Информация' => [
                    'Слово' => $paradigm->getBaseForm(),
                    'Граммемы' => $paradigm[0]->getGrammems(),
                    'Часть речи' => $partOfSpeech,
                ],
                'Жесты' => HelpMorphyService::hasInJests($paradigm->getBaseForm(), $paradigm[0]->getGrammems(), $partOfSpeech)
            ];
        }

        return $resultArray;
    }

    /**
     * Возвращает базовую форму слова.
     * @param $word
     * @param $grammems
     * @param $partOfSpeech
     * @return false|string|string[]
     */
    public static function baseWordForm($word, $grammems, $partOfSpeech)
    {
        $morphy = new Morphy(Morphy::russianLang);

        $paradigms = $morphy->findWord($word);

        if (empty($grammems)) {
            return mb_strtolower($word, 'UTF-8');
        }

        foreach ($paradigms->getByPartOfSpeech($partOfSpeech) as $paradigm) {
            foreach ($paradigm->getWordFormsByPartOfSpeech($partOfSpeech) as $form) {
                if ($form->hasGrammems($grammems)) {
                    return mb_strtolower($paradigm->getBaseForm(), 'UTF-8');
                }
            }
        }
    }
}
