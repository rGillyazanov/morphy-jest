<?php

namespace App\Http\Controllers;

use App\Models\Jest;
use App\Models\Morphies\JestWordForms;
use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\WordFormJestsSostav;
use App\Models\Morphies\WordFormsModel;
use App\Models\Morphies\WordGrammems;
use App\Models\Morphy\HelpMorphyService;
use App\Models\Morphy\MorphyAnalyzer;
use App\Models\Word;

use Illuminate\Http\Request;
use SEOService2020\Morphy\Morphy;

class TestController extends Controller
{
    public function show($word) {
        try {
            $morphyAnalyzer = new MorphyAnalyzer($word);

            $this->saveWord($word);

            return response()->json([
                $morphyAnalyzer->getTypesOfWord(),
            ],200, [
                'Content-Type' => 'application/json;charset=UTF-8',
            ], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTrace()
            ], 404);
        }
    }

    /**
     * Сохраняет все словоформы у выбранного слова.
     * @param $word
     */
    private function saveWord($word)
    {
        $morphy = new Morphy(Morphy::russianLang);

        if (preg_match( '/^([а-я]+)$/u', mb_strtolower($word, 'UTF-8'))) {
            $allFormsWithGram = $morphy->getAllFormsWithGramInfo($word);

            if ($allFormsWithGram) {

                WordFormsModel::query()->firstOrCreate(
                    ['word' => mb_strtolower($word, 'UTF-8')]
                );

                foreach ($allFormsWithGram as $forms) {
                    for ($indexForm = 0; $indexForm < count($forms['forms']); $indexForm++) {

                        WordFormsModel::query()->firstOrCreate(
                            ['word' => mb_strtolower($forms['forms'][$indexForm], 'UTF-8')]
                        );

                        $allGrams = explode(" ", trim($forms['all'][$indexForm]));

                        $partOfSpeech = $allGrams[0];

                        $wordForm = WordFormsModel::query()->firstWhere('word', mb_strtolower($forms['forms'][$indexForm], 'UTF-8'));

                        if ($wordForm) {
                            $partOfSpeechModel = PartOfSpeech::query()->firstWhere('descriptor', $partOfSpeech);

                            $attributes = [];
                            if ($partOfSpeechModel) {
                                $attributes['word_id'] = $wordForm->id;
                                $attributes['part_of_speech_id'] = $partOfSpeechModel->id;

                                if (isset($allGrams[1])) {
                                    $grammems = explode(",", $allGrams[1]);
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

                                    $attributes['base_word_form_id'] =
                                        WordFormsModel::query()->firstOrCreate([
                                            'word' => HelpMorphyService::baseWordForm($wordForm->word, $grammems, $partOfSpeechModel->descriptor)
                                        ])->id;
                                } else {
                                    $attributes['base_word_form_id'] =
                                        WordFormsModel::query()->firstOrCreate([
                                            'word' => HelpMorphyService::baseWordForm($wordForm->word, [], $partOfSpeechModel->descriptor)
                                        ])->id;
                                }

                                WordGrammems::query()->firstOrCreate(
                                    $attributes
                                );
                            }
                        }
                    }
                }

                WordFormsModel::query()->firstOrCreate([
                    'word' => mb_strtolower($word, 'UTF-8')
                ]);
            }
        }
    }

    public function allWords(Request $request)
    {
        $filter = [
            'admin_checked' => 1
        ];
        $search = $request->input('search');

        return Word::search($search)->ofFilter($filter)
            ->limit(1000)->get(['id_word', 'word'])->toJSON(JSON_UNESCAPED_UNICODE);
    }

    public function jestsOfWord($wordId)
    {
        return ($wordId === null) ? []
            : Word::findOrFail($wordId)->jests()
                ->orderBy('jest')->whereAdminChecked(1)
                ->get(['srd_surd_jest.id_jest', 'jest', 'nedooformleno']);
    }

    public function allWordsOfJest($jestId)
    {
        return Jest::query()->where('id_jest', $jestId)->with(['words:id_word,word'])->get(['id_jest'])->toJSON(JSON_UNESCAPED_UNICODE);
    }

    public function storeWordFormsInJest(Request $request)
    {
        // Получаем Id жеста.
        $inputJestId = $request->get('jest_id');
        $inputWordId = $request->get('word_id');

        // Массив выбранных словоформ.
        $wordForms = $request->get('wordForms');

        /**
         * Так как словоформы представлены в формате JSON,
         * необходимо декодировать их для дальнейшей обработки.
         */
        $words = json_decode($wordForms);

        /**
         * Массив для записи идендификаторов словоформ
         * необходим для сравнивая слов при повторном редактировании
         * словоформ.
         */
        $wordsGrammem = [];

        // Проходимся по JSON массиву и получаем Слово, граммемы и часть речи.
        // После чего получаем ID граммем из таблиц и заполняем связывающую таблицу word_grammems.
        foreach ($words as $wordJSON) {
            $word = json_decode($wordJSON, true);

            WordFormsModel::query()->firstOrCreate(
                ['word' => mb_strtolower($word['Слово'], 'UTF-8')]
            );

            $wordId = WordFormsModel::query()->firstWhere('word', mb_strtolower($word['Слово'], 'UTF-8'))->id;
            $partOfSpeechId = PartOfSpeech::query()->firstWhere('descriptor', $word['Часть речи'])->id;

            $attributes = [];
            $attributes['word_id'] = $wordId;
            $attributes['part_of_speech_id'] = $partOfSpeechId;
            $attributes['base_word_form_id'] =
                WordFormsModel::query()->firstOrCreate([
                    'word' => HelpMorphyService::baseWordForm($word['Слово'], $word['Граммемы'], $word['Часть речи'])
                ])->id;

            foreach ($word['Граммемы'] as $grammem) {
                foreach (HelpMorphyService::getDescriptors() as $descriptor => $item) {
                    $grammem = mb_strtolower($grammem, 'UTF-8');
                    if ($grammem === $descriptor) {

                        $model = new $item['model']();

                        $idGrammema = $model::query()->where('grammema', $grammem)->first()->id;

                        $attributes[$item['word_grammems_id']] = $idGrammema;
                    }
                }
            }

            $wordGrammem = WordGrammems::query()->firstOrCreate(
                $attributes
            );

            if ($wordGrammem) {
                $wordsGrammem[] = $wordGrammem->id;
            }
        }

        // Словоформы на предыдущем заполнении.
        $previousRecords = JestWordForms::query()->where('jest_id', $inputJestId)
            ->where('word_id', '=', $inputWordId, 'and')
            ->get(['wordform_id'])->toArray();

        $previousIds = [];
        foreach ($previousRecords as $previousRecord) {
            $previousIds[] = $previousRecord['wordform_id'];
        }

        // Словоформы, которые нужно удалить, если с них убрали Checkbox.
        $removedIds = array_diff(array_unique(array_merge($previousIds, $wordsGrammem)), $wordsGrammem);

        // Словоформы, которые остались в активным Checkbox-ом.
        $currentIds = array_merge(array_intersect($previousIds, $wordsGrammem), array_diff($wordsGrammem, $previousIds));

        // Если были убраны все словоформы, удаляем привязку жеста к словоформам.
        if (count($wordsGrammem) === 0) {
            JestWordForms::query()->where('jest_id', $inputJestId)
                ->where('word_id', '=', $inputWordId, 'and')
                ->delete();
        } else {
            // Если есть словоформы, которые нужно удалить, удаляем их из привязанного жеста.
            if (count($removedIds) > 0) {
                foreach ($removedIds as $removedId) {
                    JestWordForms::query()->where('jest_id', $inputJestId)
                        ->where('word_id', '=', $inputWordId, 'and')
                        ->where('wordform_id', $removedId)->delete();
                }
            }

            // Записываем или обновляем словоформы, которые остались активными в жесте.
            foreach ($currentIds as $currentId) {
                JestWordForms::query()->updateOrCreate(
                    ['jest_id' => $inputJestId, 'word_id' => $inputWordId, 'wordform_id' => $currentId]
                );
            }
        }
    }

    public function getWordFormsInJest($jestId, $wordId)
    {
        $words = JestWordForms::query()
            ->where('jest_id', $jestId)
            ->where('word_id', $wordId)->get();

        $wordsGrammems = [];

        foreach ($words as $word) {
            $wordsGrammems[] = $word->wordForm->json();
        }

        return response()->json($wordsGrammems, 200, [], 256);
    }

    public function searchJest(Request $request)
    {
        $searchText = $request->input('search');

        return Jest::where('jest', 'like', "%$searchText%")->limit(100)->orderBy('jest')->get(['id_jest', 'jest', 'nedooformleno']);
    }

    public function storeJestsWordForm(Request $request)
    {
        // Словоформы с составом жестов.
        $wordFormsWithJestsJSON = $request->get('wordFormsWithJests');
        $wordIdSelected = $request->get('word_id');

        $wordFormsWithJests = json_decode($wordFormsWithJestsJSON, true);

        if (count($wordFormsWithJests) > 0) {
            foreach ($wordFormsWithJests as $wordFormInfo => $jests) {
                $wordInfo = json_decode($wordFormInfo, true);

                $word = WordFormsModel::query()->firstOrCreate(
                    ['word' => mb_strtolower($wordInfo['Слово'], 'UTF-8')]
                );

                $partOfSpeechId = PartOfSpeech::query()->firstWhere('descriptor', mb_strtoupper($wordInfo['Часть речи'], 'UTF-8'))->id;

                $attributes = [];
                $attributes['word_id'] = $word->id;
                $attributes['part_of_speech_id'] = $partOfSpeechId;
                $attributes['base_word_form_id'] =
                    WordFormsModel::query()->firstOrCreate([
                        'word' => HelpMorphyService::baseWordForm($wordInfo['Слово'], $wordInfo['Граммемы'], $wordInfo['Часть речи'])
                    ])->id;

                foreach ($wordInfo['Граммемы'] as $grammem) {
                    foreach (HelpMorphyService::getDescriptors() as $descriptor => $item) {
                        $grammem = mb_strtolower($grammem, 'UTF-8');
                        if ($grammem === $descriptor) {

                            $model = new $item['model']();

                            $idGrammema = $model::query()->where('grammema', $grammem)->first()->id;

                            $attributes[$item['word_grammems_id']] = $idGrammema;
                        }
                    }
                }

                $wordGrammem = WordGrammems::query()->firstOrCreate(
                    $attributes
                );

                $wordFormId = $wordGrammem->id;

                // Словоформы на предыдущем заполнении.
                $previousRecords = WordFormJestsSostav::query()->where('word_id', $word->id)->get(['wordform_id'])->toArray();

                $previousIds = [];
                foreach ($previousRecords as $previousRecord) {
                    $previousIds[] = $previousRecord['wordform_id'];
                }

                // Словоформы, которые нужно удалить, если с них убрали Checkbox.
                $removedIds = array_diff(array_unique(array_merge($previousIds, [$wordFormId])), [$wordFormId]);

                // Если есть словоформы, которые нужно удалить, удаляем их из привязанного жеста.
                if (count($removedIds) > 0) {
                    foreach ($removedIds as $removedId) {
                        WordFormJestsSostav::query()->where('wordform_id', $removedId)->where('word_id', '=', $wordIdSelected, 'and')->delete();
                    }
                }

                // Записываем или обновляем словоформы, которые остались активными в жесте.
                foreach ($jests as $jest) {
                    WordFormJestsSostav::query()->updateOrCreate(
                        [
                            'word_id' => $wordIdSelected,
                            'wordform_id' => $wordFormId,
                            'jest_id' => $jest['jest']['id_jest']
                        ],
                        [
                            'order' => $jest['order']
                        ]
                    );
                }
            }
        } else {
            WordFormJestsSostav::query()->where('word_id', $wordIdSelected)->delete();
        }

    }

    public function wordFormJestsInWord($wordId)
    {
        // Слово с составом жестов
        $wordFormsWithJestsSostav = Word::query()->findOrFail($wordId)->wordFormJestsSostav->groupBy('wordform_id');

        /**
         * Массив вида:
         * [ "Json словоформы" => массив жестов словоформы ]
         */
        $wordFormsJests = [];

        foreach ($wordFormsWithJestsSostav as $groupWordFormId => $jests) {
            $wordJsonInfo = WordGrammems::query()->findOrFail($groupWordFormId)->json();

            $wordJsonInfo = json_encode($wordJsonInfo, 256);

            $wordFormsJests[$wordJsonInfo] = [];

            foreach ($jests as $jest) {
                $jestModel = Jest::query()->where('id_jest', $jest->jest_id)->first(['id_jest', 'jest', 'nedooformleno']);

                $jestTemp = [
                    'id_jest' => $jestModel->id_jest,
                    'jest' => $jestModel->jest,
                    'nedooformleno' => $jestModel->nedooformleno
                ];

                $wordFormsJests[$wordJsonInfo][] = [
                    'jest' => $jestTemp,
                    'order' => $jest->order
                ];
            }

            usort($wordFormsJests[$wordJsonInfo], function ($item1, $item2) {
                return $item1['order'] <=> $item2['order'];
            });
        }

        return response()->json($wordFormsJests, 200, [], 256);
    }
}
