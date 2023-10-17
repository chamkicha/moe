<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRegistrationStructureId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachment_types', function (Blueprint $table) {
            $table->bigInteger('registration_structure_id')->nullable()->after('application_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachment_types', function (Blueprint $table) {
            $table->dropColumn('registration_structure_id');
        });
    }
}
