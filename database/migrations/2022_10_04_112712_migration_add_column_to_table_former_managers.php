<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnToTableFormerManagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('former_managers', function (Blueprint $table) {
            $table->longText('manager_cv')->nullable();
            $table->longText('manager_certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('former_managers', function (Blueprint $table) {
            $table->dropColumn('manager_cv');
            $table->dropColumn('manager_certificate');
        });
    }
}
