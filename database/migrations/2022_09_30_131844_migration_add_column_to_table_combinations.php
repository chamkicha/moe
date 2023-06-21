<?php

use App\Models\Certificate_type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnToTableCombinations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combinations', function (Blueprint $table) {
            $table->foreignIdFor(Certificate_type::class,'certificate_type_id')->nullable()->index()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combinations', function (Blueprint $table) {
            $table->dropColumn('certificate_type_id');
        });
    }
}
