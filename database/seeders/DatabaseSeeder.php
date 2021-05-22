<?php

namespace Database\Seeders;

use Database\Seeders\Morphy\CaseSeeder;
use Database\Seeders\Morphy\EnthusiasmSeeder;
use Database\Seeders\Morphy\FaceSeeder;
use Database\Seeders\Morphy\GenderSeeder;
use Database\Seeders\Morphy\NumberSeeder;
use Database\Seeders\Morphy\OtherSeeder;
use Database\Seeders\Morphy\PartOfSpeechSeeder;
use Database\Seeders\Morphy\PledgeSeeder;
use Database\Seeders\Morphy\SemanticFeaturesSeeder;
use Database\Seeders\Morphy\TimeSeeder;
use Database\Seeders\Morphy\TransitivitySeeder;
use Database\Seeders\Morphy\ViewSeeder;
use Database\Seeders\Morphy\WordFormsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*(new CaseSeeder())->run();
        (new EnthusiasmSeeder())->run();
        (new FaceSeeder())->run();
        (new GenderSeeder())->run();
        (new NumberSeeder())->run();
        (new OtherSeeder())->run();
        (new PartOfSpeechSeeder())->run();
        (new PledgeSeeder())->run();
        (new SemanticFeaturesSeeder())->run();
        (new TimeSeeder())->run();
        (new TransitivitySeeder())->run();
        (new ViewSeeder())->run();*/
        (new WordFormsSeeder())->run();
    }
}
