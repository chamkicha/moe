<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVillageIdColumnEstablishingSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishing_schools', function (Blueprint $table) {
            $table->string('village_id', 100)->nullable()->after('ward_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establing_schools', function (Blueprint $table) {
            $table->dropColumn('village_id');
        });
    }
}
