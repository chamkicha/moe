<?php

namespace Database\Seeders;

use App\Models\Identity_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IdentityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identities = [
            'Kitambulisho cha taifa',
            'Kadi ya mpiga kura',
            'Cheti cha kuzaliwa',
            'Hati ya kusafiria',
            'Leseni ya udereva'
        ];

        foreach ($identities as $identity){

            Identity_type::create([
                'secure_token' => Str::random(40),
                'id_type' => $identity
            ]);
        }
    }
}
