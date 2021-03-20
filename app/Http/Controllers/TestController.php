<?php

namespace App\Http\Controllers;

use App\Models\Morphy\MorphyAnalyzer;
use SEOService2020\Morphy\Morphy;

class TestController extends Controller
{
    public function index()
    {
        $morphy = new Morphy(Morphy::russianLang);

        $counter = 0;

        $word = 'СОБАКИ';
        $collection = $morphy->findWord($word);

        echo "Слово $word<br>";

        // обрабатываем омонимы
        foreach($collection as $paradigm) {
            $counter++;

            $baseForm = $paradigm->getBaseForm();

            echo "$counter.<br>";
            echo 'Лемма: ', $baseForm, "<br>";
            //echo 'Все формы: ', implode(',', $paradigm->getAllForms()), "<br>";

            // информация о искомом слове т.к. в парадигме словоформы могут повторятся $found_word - массив
            $found_word_ary = $paradigm->getFoundWordForm();

            if($paradigm->hasGrammems('НО')) {
                echo "$word - неодушевлённое\n";
            }

            echo 'форм в именительном падеже = ', count($paradigm->getWordFormsByGrammems('ИМ')), "<br>";

            // аналогично используется hasPartOfSpeech, getWordFormsByPartOfSpeech

            echo "<br>". 'Все формы с грамматической информацией'. "<br>";
            echo "<ul>";

            var_dump($paradigm->getWordFormsByGrammems(['РД', 'ЕД'])[0]->getWord());

            foreach($paradigm as $form) {

                $formWord = $form->getWord();

                $grammemsDublicate = [];
                $grammemsPartOfSpeech;
                // Одинаковые слова с галочкой
                foreach($found_word_ary as $found_form) {
                    $grammemsPartOfSpeech = $found_form->getPartOfSpeech();
                    $grammemsDublicate = array_merge($grammemsDublicate, $found_form->getGrammems());
                }

                if ($word == $formWord) {
                    echo "<li><span style='color: red'>".$formWord."</span> - ";
                } else {
                    echo "<li>".$formWord, ' - ';
                }

                switch ($form) {
                    case $form->hasGrammems('ИМ'):
                        echo 'Именительный';
                        break;
                    case $form->hasGrammems('РД'):
                        echo 'Родительный';
                        break;
                    case $form->hasGrammems('ДТ'):
                        echo 'Дательный';
                        break;
                    case $form->hasGrammems('ВН'):
                        echo 'Винительный';
                        break;
                    case $form->hasGrammems('ТВ'):
                        echo 'Творительный';
                        break;
                    case $form->hasGrammems('ПР'):
                        echo 'Предложный';
                        break;
                    case $form->hasGrammems('ЗВ'):
                        echo 'Звательный';
                        break;
                    default:
                        break;
                }

                if ($form->hasGrammems('ЕД')) {
                    echo ' единственное число'."</li><br>";
                } else if ($form->hasGrammems('МН')) {
                    echo ' множественное число'."</li><br>";
                }
            }

            echo "</ul>";

            echo "<br>";
        }
    }

    public function test($word) {
        try {
            $morphyAnalyzer = new MorphyAnalyzer($word);
            dd($morphyAnalyzer->getTypesOfWord());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
