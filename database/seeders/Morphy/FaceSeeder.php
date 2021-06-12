<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Face;
use Illuminate\Database\Seeder;

class FaceSeeder extends Seeder
{
    private array $faces = [
        [
            'grammema' => '1л',
            'description' => 'первое лицо'
        ],
        [
            'grammema' => '2л',
            'description' => 'второе лицо'
        ],
        [
            'grammema' => '3л',
            'description' => 'третье лицо'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->faces as $face) {
            Face::query()->insert([
                'grammema' => $face['grammema'],
                'description' => $face['description']
            ]);
        }
    }
}
