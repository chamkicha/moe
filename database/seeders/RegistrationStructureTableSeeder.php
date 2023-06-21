<?php

namespace Database\Seeders;

use App\Models\Registration_structure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegistrationStructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reg_structures = [
            'Hakuna majengo',
            'Kuna majengo'
        ];

        foreach ($reg_structures as $reg_structure){

            Registration_structure::create([
                'secure_token' => Str::random(40),
                'structure' => $reg_structure
            ]);
        }
    }
}
