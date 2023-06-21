<?php

namespace Database\Seeders;

use App\Models\School_sub_category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolSubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_categories = [
            'Kutwa',
            'Bweni'
        ];

        foreach ($sub_categories as $sub_category){
            School_sub_category::create([
                'secure_token' => Str::random(40),
                'subcategory' => $sub_category
            ]);
        }
    }
}
