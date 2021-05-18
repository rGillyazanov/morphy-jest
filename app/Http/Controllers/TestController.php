<?php

namespace App\Http\Controllers;

use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\Word;
use App\Models\Morphies\WordGrammems;
use App\Models\Morphy\HelpMorphyService;
use App\Models\Morphy\MorphyAnalyzer;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test($word) {
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

    public function saveWords(Request $request)
    {
        $wordsJSON = $request->get('words');

        $words = json_decode($wordsJSON);

        // Проходимся по JSON массиву и получаем Слово, граммемы и часть речи.
        // После чего получаем ID граммем из таблиц и заполняем связывающую таблицу word_grammems.
        foreach ($words as $wordJSON) {
            $word = json_decode($wordJSON, true);

            Word::query()->firstOrCreate(
                ['word' => mb_strtolower($word['Слово'], 'UTF-8')]
            );

            $wordId = Word::query()->firstWhere('word', mb_strtolower($word['Слово'], 'UTF-8'))->id;
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

            WordGrammems::query()->firstOrCreate(
                $attributes
            );
        }
    }
}
