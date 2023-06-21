<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRegStatusToTableSchoolRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_registrations', function (Blueprint $table) {
            $table->integer('reg_status')->default(1)->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
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
            $table->dropColumn('reg_status');
            $table->dropColumn('deleted_at');
        });
    }
}
