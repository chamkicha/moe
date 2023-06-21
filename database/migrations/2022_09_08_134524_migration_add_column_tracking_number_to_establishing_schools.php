<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnTrackingNumberToEstablishingSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishing_schools', function (Blueprint $table) {
            $table->string('tracking_number')->nullable();
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
            $table->dropColumn('tracking_number');
        });
    }
}
