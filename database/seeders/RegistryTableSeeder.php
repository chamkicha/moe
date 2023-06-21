<?php

namespace Database\Seeders;

use App\Models\Registry_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegistryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registries = [
            'Mtu binafsi',
            'Taasisi/Kampuni/NGO',
            'Serikali/Halmashauri'
        ];

        foreach ($registries as $registry){

            Registry_type::create([
                'secure_token' => Str::random(40),
                'registry' => $registry
            ]);
        }
    }
}
