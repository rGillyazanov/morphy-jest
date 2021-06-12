<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Enthusiasm;
use Illuminate\Database\Seeder;

class EnthusiasmSeeder extends Seeder
{
    private array $enthusiasms = [
        [
            'grammema' => 'од',
            'description' => 'одушевленное'
        ],
        [
            'grammema' => 'но',
            'description' => 'неодушевленное'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->enthusiasms as $enthusiasm) {
            Enthusiasm::query()->insert([
                'grammema' => $enthusiasm['grammema'],
                'description' => $enthusiasm['description']
            ]);
        }
    }
}
