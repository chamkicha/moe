<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurriculaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curricula = [
            'Cambridge International Education(CIE)',
            'Association of International School in Africa(AISA)',
            'European Council of International School(ECIS)',
        ];

        foreach ($curricula as $cur){

            Curriculum::create([
                'secure_token' => Str::random(40),
                'curriculum' => $cur
            ]);
        }
    }
}
