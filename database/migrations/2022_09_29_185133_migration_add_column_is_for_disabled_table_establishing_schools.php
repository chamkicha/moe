<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnIsForDisabledTableEstablishingSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishing_schools', function (Blueprint $table) {
            $table->boolean('is_for_disabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establishing_schools', function (Blueprint $table) {
            $table->dropColumn('is_for_disabled');
        });
    }
}
