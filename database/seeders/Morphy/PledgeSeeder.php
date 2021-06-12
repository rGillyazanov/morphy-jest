<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\Pledge;
use Illuminate\Database\Seeder;

class PledgeSeeder extends Seeder
{
    private array $pledges = [
        [
            'grammema' => 'дст',
            'description' => 'действительный залог'
        ],
        [
            'grammema' => 'стр',
            'description' => 'страдательный залог'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->pledges as $pledge) {
            Pledge::query()->insert([
                'grammema' => $pledge['grammema'],
                'description' => $pledge['description']
            ]);
        }
    }
}
