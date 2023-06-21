<?php

namespace Database\Seeders;

use App\Models\Certificate_type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CertificateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = [
            'CSEE',
            'ACSEE'
        ];

        foreach ($certificates as $certificate){

            Certificate_type::create([
                'secure_token' => Str::random(40),
                'certificate' => $certificate
            ]);
        }
    }
}
