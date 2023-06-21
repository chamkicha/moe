<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            'English',
            'Kiswahili'
        ];

        foreach ($languages as $language){

            Language::create([
                'secure_token' => Str::random(40),
                'language' => $language
            ]);
        }
    }
}
