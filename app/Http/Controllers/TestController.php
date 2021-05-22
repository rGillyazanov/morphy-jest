<?php

namespace App\Http\Controllers;

use App\Models\Jest;
use App\Models\Morphies\JestWordForms;
use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\WordFormsModel;
use App\Models\Morphies\WordGrammems;
use App\Models\Morphy\HelpMorphyService;
use App\Models\Morphy\MorphyAnalyzer;

use App\Models\Word;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show($word) {
        try {
            $morphyAnalyzer = new MorphyAnalyzer($word);

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

    public function allWords()
    {
        $filter = [
            'admin_checked' => 1
        ];

        return Word::query()->ofFilter($filter)->limit(1000)->get(['id_word', 'word'])->toJSON(JSON_UNESCAPED_UNICODE);
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
        $jestId = $request->get('jest_id');
        $wordForms = $request->get('wordForms');

        $words = json_decode($wordForms);

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

            $attributes['word_id'] = $wordId;
            $attributes['part_of_speech_id'] = $partOfSpeechId;

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

        $previousRecords = JestWordForms::query()->where('jest_id', $jestId)->get(['wordform_id'])->toArray();

        $previousIds = [];
        foreach ($previousRecords as $previousRecord) {
            $previousIds[] = $previousRecord['wordform_id'];
        }

        $removedIds = array_diff(array_unique(array_merge($previousIds, $wordsGrammem)), $wordsGrammem);
        $currentIds = array_merge(array_intersect($previousIds, $wordsGrammem), array_diff($wordsGrammem, $previousIds));

        if (count($wordsGrammem) === 0) {
            JestWordForms::query()->where('jest_id', $jestId)->delete();
        } else {
            if (count($removedIds) > 0) {
                foreach ($removedIds as $removedId) {
                    JestWordForms::query()->where('wordform_id', $removedId)->delete();
                }
            }
            foreach ($currentIds as $currentId) {
                JestWordForms::query()->updateOrCreate(
                    ['jest_id' => $jestId, 'wordform_id' => $currentId]
                );
            }
        }
    }
}
