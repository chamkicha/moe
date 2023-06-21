<?php

use App\Models\Denomination;
use App\Models\Ownership_sub_type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTableOwners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->foreignIdFor(Ownership_sub_type::class,'ownership_sub_type_id')->nullable()->index()->constrained();
            $table->foreignIdFor(Denomination::class,'denomination_id')->nullable()->index()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('ownership_sub_type_id');
            $table->dropColumn('denomination_id');
        });
    }
}
