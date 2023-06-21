<?php

namespace Database\Seeders;

use App\Models\School_category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school_categories = [
            'Awali pekee',
            'Awali na Msingi',
            'Sekondari',
            'Chuo cha ualimu'
        ];

        foreach ($school_categories as $school_category){
            School_category::create([
                'secure_token' => Str::random(40),
                'category' => $school_category
            ]);
        }
    }
}
