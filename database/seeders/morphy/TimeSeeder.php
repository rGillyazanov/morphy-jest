<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Time;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    private array $times = [
        [
            'grammema' => 'нст',
            'description' => 'настоящее время'
        ],
        [
            'grammema' => 'буд',
            'description' => 'будущее время'
        ],
        [
            'grammema' => 'прш',
            'description' => 'прошедшее время'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->times as $time) {
            Time::query()->insert([
                'grammema' => $time['grammema'],
                'description' => $time['description']
            ]);
        }
    }
}
