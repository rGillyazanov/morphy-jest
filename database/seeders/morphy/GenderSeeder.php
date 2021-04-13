<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    private array $genders = [
        [
            'grammema' => 'мр',
            'description' => 'мужской род'
        ],
        [
            'grammema' => 'жр',
            'description' => 'женский род'
        ],
        [
            'grammema' => 'ср',
            'description' => 'средний род'
        ],
        [
            'grammema' => 'мр-жр',
            'description' => 'общий род'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->genders as $gender) {
            Gender::query()->insert([
                'grammema' => $gender['grammema'],
                'description' => $gender['description']
            ]);
        }
    }
}
