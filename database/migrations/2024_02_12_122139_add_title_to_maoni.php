<?php

use Doctrine\DBAL\Schema\Column;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToMaoni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maoni', function (Blueprint $table) {
            $table->string('title', 100)->after('coments');
            // $table->string('name', 190)->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maoni', function (Blueprint $table) {
            $table->dropColumn('title');
            // $table->dropColumn('name');
        });
    }
}
