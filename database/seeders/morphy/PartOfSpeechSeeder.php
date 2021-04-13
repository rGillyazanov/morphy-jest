<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\PartOfSpeech;
use Illuminate\Database\Seeder;

class PartOfSpeechSeeder extends Seeder
{
    private array $partsOfSpeech = [
        [
            'descriptor' => 'C',
            'description' => 'существительное'
        ],
        [
            'descriptor' => 'П',
            'description' => 'прилагательное'
        ],
        [
            'descriptor' => 'КР_ПРИЛ',
            'description' => 'краткое прилагательное'
        ],
        [
            'descriptor' => 'ИНФИНИТИВ',
            'description' => 'инфинитив'
        ],
        [
            'descriptor' => 'Г',
            'description' => 'глагол в личной форме'
        ],
        [
            'descriptor' => 'ДЕЕПРИЧАСТИЕ',
            'description' => 'деепричастие'
        ],
        [
            'descriptor' => 'ПРИЧАСТИЕ',
            'description' => 'причастие'
        ],
        [
            'descriptor' => 'КР_ПРИЧАСТИЕ',
            'description' => 'краткое причастие'
        ],
        [
            'descriptor' => 'ЧИСЛ',
            'description' => 'числительное (количественное)'
        ],
        [
            'descriptor' => 'ЧИСЛ-П',
            'description' => 'порядковое числительное'
        ],
        [
            'descriptor' => 'МС',
            'description' => 'местоимение-существительное'
        ],
        [
            'descriptor' => 'МС-ПРЕДК',
            'description' => 'местоимение-предикатив'
        ],
        [
            'descriptor' => 'МС-П',
            'description' => 'местоименное прилагательное'
        ],
        [
            'descriptor' => 'Н',
            'description' => 'наречие'
        ],
        [
            'descriptor' => 'ПРЕДК',
            'description' => 'предикатив'
        ],
        [
            'descriptor' => 'ПРЕДЛ',
            'description' => 'предлог'
        ],
        [
            'descriptor' => 'СОЮЗ',
            'description' => 'союз'
        ],
        [
            'descriptor' => 'МЕЖД',
            'description' => 'междометие'
        ],
        [
            'descriptor' => 'ЧАСТ',
            'description' => 'частица'
        ],
        [
            'descriptor' => 'ВВОДН',
            'description' => 'вводное слово'
        ],
        [
            'descriptor' => 'ФРАЗ',
            'description' => 'фразеологизм'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->partsOfSpeech as $partOfSpeech) {
            PartOfSpeech::query()->insert([
                'descriptor' => $partOfSpeech['descriptor'],
                'description' => $partOfSpeech['description']
            ]);
        }
    }
}
