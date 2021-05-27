<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\SemanticFeature;
use Illuminate\Database\Seeder;

class SemanticFeaturesSeeder extends Seeder
{
    private array $semanticsFeatures = [
        [
            'grammema' => 'имя',
            'description' => 'имя'
        ],
        [
            'grammema' => 'фам',
            'description' => 'фамилия'
        ],
        [
            'grammema' => 'отч',
            'description' => 'отчество'
        ],
        [
            'grammema' => 'лок',
            'description' => 'топоним'
        ],
        [
            'grammema' => 'аббр',
            'description' => 'аббревиатура'
        ],
        [
            'grammema' => 'орг',
            'description' => 'организация'
        ],
        [
            'grammema' => 'вопр',
            'description' => 'вопросительное наречие'
        ],
        [
            'grammema' => 'указат',
            'description' => 'указательное наречие'
        ],
        [
            'grammema' => 'жарг',
            'description' => 'жаргонизм'
        ],
        [
            'grammema' => 'разг',
            'description' => 'разговорный'
        ],
        [
            'grammema' => 'арх',
            'description' => 'архаизм'
        ],
        [
            'grammema' => 'опч',
            'description' => 'опечатка'
        ],
        [
            'grammema' => 'поэт',
            'description' => 'поэтическое'
        ],
        [
            'grammema' => 'проф',
            'description' => 'профессионализм'
        ],
        [
            'grammema' => 'полож',
            'description' => '??? (не используется)'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->semanticsFeatures as $semanticFeature) {
            SemanticFeature::query()->insert([
                'grammema' => $semanticFeature['grammema'],
                'description' => $semanticFeature['description']
            ]);
        }
    }
}
