<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Number;
use Illuminate\Database\Seeder;

class NumberSeeder extends Seeder
{
    private array $numbers = [
        [
            'grammema' => 'ед',
            'description' => 'единственное число'
        ],
        [
            'grammema' => 'мн',
            'description' => 'множественное число'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->numbers as $number) {
            Number::query()->insert([
                'grammema' => $number['grammema'],
                'description' => $number['description']
            ]);
        }
    }
}
