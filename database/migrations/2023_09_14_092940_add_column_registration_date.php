<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRegistrationDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_registrations', function (Blueprint $table) {
            $table->date('registration_date')->nullable()->after('school_opening_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_registrations', function (Blueprint $table) {
            $table->dropColumn('registration_date');
        });
    }
}
