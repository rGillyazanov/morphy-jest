<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Other;
use Illuminate\Database\Seeder;

class OtherSeeder extends Seeder
{
    private array $others = [
        [
            'grammema' => '0',
            'description' => 'неизменяемое'
        ],
        [
            'grammema' => 'безл',
            'description' => 'безличный глагол'
        ],
        [
            'grammema' => 'пвл',
            'description' => '	повелительное наклонение (императив)'
        ],
        [
            'grammema' => 'притяж',
            'description' => 'притяжательное (не используется)'
        ],
        [
            'grammema' => 'прев',
            'description' => 'превосходная степень (для прилагательных)'
        ],
        [
            'grammema' => 'сравн',
            'description' => 'сравнительная степень (для прилагательных)'
        ],
        [
            'grammema' => 'кач',
            'description' => 'качественное прилагательное'
        ],
        [
            'grammema' => 'дфст',
            'description' => '??? прилагательное (не используется)'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->others as $other) {
            Other::query()->insert([
                'grammema' => $other['grammema'],
                'description' => $other['description']
            ]);
        }
    }
}
