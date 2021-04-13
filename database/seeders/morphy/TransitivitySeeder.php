<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Transitivity;
use Illuminate\Database\Seeder;

class TransitivitySeeder extends Seeder
{
    private array $transitivities = [
        [
            'grammema' => 'нп',
            'description' => 'переходный'
        ],
        [
            'grammema' => 'пе',
            'description' => 'непереходный'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->transitivities as $transitivity) {
            Transitivity::query()->insert([
                'grammema' => $transitivity['grammema'],
                'description' => $transitivity['description']
            ]);
        }
    }
}
