<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\CaseModel;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    private array $cases = [
        [
            'grammema' => 'им',
            'description' => 'именительный'
        ],
        [
            'grammema' => 'рд',
            'description' => 'родительный'
        ],
        [
            'grammema' => 'дт',
            'description' => 'дательный'
        ],
        [
            'grammema' => 'вн',
            'description' => 'винительный'
        ],
        [
            'grammema' => 'тв',
            'description' => 'творительный'
        ],
        [
            'grammema' => 'пр',
            'description' => 'предложный'
        ],
        [
            'grammema' => 'зв',
            'description' => 'звательный'
        ],
        [
            'grammema' => '2',
            'description' => 'второй родительный или второй предложный падежи'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cases as $case) {
            CaseModel::query()->insert([
                'grammema' => $case['grammema'],
                'description' => $case['description']
            ]);
        }
    }
}
