<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTrackingNumberToTableFormerSchoolCombinations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('former_school_combinations', function (Blueprint $table) {
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
        Schema::table('former_school_combinations', function (Blueprint $table) {
            $table->dropColumn('tracking_number');
        });
    }
}
