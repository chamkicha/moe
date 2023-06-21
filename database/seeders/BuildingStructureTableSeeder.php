<?php

namespace Database\Seeders;

use App\Models\Building_structure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BuildingStructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $building_structures = [
            'Msambao',
            'Ghorofa'
        ];

        foreach ($building_structures as $building_structure){
            Building_structure::create([
                'secure_token' => Str::random(40),
                'building' => $building_structure
            ]);
        }
    }
}
