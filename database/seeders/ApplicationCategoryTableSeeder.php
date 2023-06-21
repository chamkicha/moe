<?php

namespace Database\Seeders;

use App\Models\Application_category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApplicationCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $application_categories = [
            'Kuanzisha shule',
            'Uthibitisho wa umiliki wa shule',
            'Kuthibitishwa kuwa Meneja wa Shule',
            'Kusajili shule',
            'Kuongeza mikondo',
            'Kubadili aina ya usajili',
            'Kubadili mmiliki wa shule',
            'Kubadili meneja wa shule',
            'Kubadili jina la shule',
            'Kuhamisha shule',
        ];

        foreach ($application_categories as $application_category){

            Application_category::create([
                'secure_token' => Str::random(40),
                'app_name' => $application_category
            ]);
        }
    }
}
