<?php

namespace Database\Seeders\Morphy;

use App\Models\Morphies\View;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    private array $views = [
        [
            'grammema' => 'св',
            'description' => 'совершенный вид'
        ],
        [
            'grammema' => 'нс',
            'description' => 'несовершенный вид'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->views as $view) {
            View::query()->insert([
                'grammema' => $view['grammema'],
                'description' => $view['description']
            ]);
        }
    }
}
