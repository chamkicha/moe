<?php

namespace Database\Seeders;

use App\Models\School_specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolSpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            'Sayansi',
            'Sanaa',
            'Sayansi na Sanaa',
            'Sayansi, Sanaa na Biashara',
            'Biashara'
        ];

        foreach ($specializations as $specialization){

            School_specialization::create([
                'specialization' => $specialization
            ]);
        }


    }
}
