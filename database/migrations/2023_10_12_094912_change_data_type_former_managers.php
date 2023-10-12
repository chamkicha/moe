<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeFormerManagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('former_managers', function (Blueprint $table) {
            $table->string('ward_id', 255)->unsigned()->change();
            $table->foreign('ward_id')->references('WardCode')->on('wards')->onDelete('cascade');
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
            $table->dropForeign('ward_id');
        });
    }
}
