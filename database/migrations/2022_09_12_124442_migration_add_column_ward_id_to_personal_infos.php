<?php

use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnWardIdToPersonalInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            $table->foreignIdFor(Ward::class,'ward_id')->nullable()->index()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            $table->dropColumn('ward_id');
        });
    }
}
