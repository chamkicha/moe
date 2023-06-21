<?php

namespace Database\Seeders;

use App\Models\Class_room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            'I-IV',
            'I-VI',
            'V-VI',
            'Astashahada',
            'Shahada',
        ];

        foreach ($classes as $class){

            Class_room::create([
                'secure_token' => Str::random(40),
                'class_range' => $class
            ]);
        }
    }
}
