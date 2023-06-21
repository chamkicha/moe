<?php

namespace Database\Seeders;

use App\Models\Sect_name;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SectNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sects = [
            'Saint',
            'Adventist'
        ];

        foreach ($sects as $sect){
            Sect_name::create([
                'secure_token' => Str::random(40),
                'word' => $sect
            ]);
        }
    }
}
