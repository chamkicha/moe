<?php

namespace Database\Seeders;

use App\Models\School_gender_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolGenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            'Wasichana tu',
            'Wavulana tu',
            'Mchanganyiko',
        ];

        foreach ($genders as $gender){

            School_gender_type::create([
                'secure_token' => Str::random(40),
                'gender_type' => $gender
            ]);
        }
    }
}
