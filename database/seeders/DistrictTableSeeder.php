<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use  Illuminate\Support\Facades\DB;

class DistrictTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'districts';
        $this->filename = base_path().'/database/seeders/csv_files/District.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        //DB::table($this->table)->truncate();

        parent::run();

    }
}
