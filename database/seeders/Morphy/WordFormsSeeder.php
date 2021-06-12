<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\PartOfSpeech;
use App\Models\Morphies\WordFormsModel;
use App\Models\Morphies\WordGrammems;
use App\Models\Morphy\HelpMorphyService;
use App\Models\Word;
use Illuminate\Database\Seeder;
use SEOService2020\Morphy\Morphy;

class WordFormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = Word::all(['word']);

        $countWords = $words->count();
        $counter = 0;
        $morphy = new Morphy(Morphy::russianLang);

        foreach ($words as $word) {
            $counter++;
            if ($counter % 100 === 0) {
                var_dump(round($counter * 100 / $countWords));
            }
            if (preg_match( '/^([а-я]+)$/u', mb_strtolower($word->word, 'UTF-8'))) {
                $allFormsWithGram = $morphy->getAllFormsWithGramInfo($word->word);

                if ($allFormsWithGram) {

                    WordFormsModel::query()->firstOrCreate(
                        ['word' => mb_strtolower($word->word, 'UTF-8')]
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
                                    }

                                    WordGrammems::query()->firstOrCreate(
                                        $attributes
                                    );
                                }
                            }
                        }
                    }

                    WordFormsModel::query()->firstOrCreate([
                        'word' => $word->word,
                        'active' => false
                    ]);
                }
            }
        }
    }
}
