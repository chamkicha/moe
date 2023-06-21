<?php

namespace Database\Seeders;

use App\Models\Application_status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class  ApplicationStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['not approved', 'approved'];

        foreach ($statuses as $status){
            Application_status::create([
                'secure_token' => Str::random(40),
                'status' => $status
            ]);
        }
    }
}
