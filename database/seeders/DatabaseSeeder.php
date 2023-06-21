<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RegionalTableSeeder::class,
            DistrictTableSeeder::class,
            WardTableSeeder::class,
            RegistryTableSeeder::class,
            ApplicationCategoryTableSeeder::class,
            ApplicationStatusTableSeeder::class,
            BuildingStructureTableSeeder::class,
            CertificateTypeTableSeeder::class,
            ClassroomTableSeeder::class,
            CurriculaTableSeeder::class,
            IdentityTableSeeder::class,
            LanguageTableSeeder::class,
            RegistrationStructureTableSeeder::class,
            SchoolCategoryTableSeeder::class,
            SchoolSubCategoryTableSeeder::class,
            SchoolGenderTableSeeder::class,
            SchoolSpecializationTableSeeder::class,
            SectNameTableSeeder::class
        ]);
    }
}
