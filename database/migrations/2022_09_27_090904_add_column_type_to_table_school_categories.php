<?php

use App\Models\Class_room;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeToTableSchoolCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_categories', function (Blueprint $table) {
            $table->foreignIdFor(Class_room::class,'class_room_id')->nullable()->index()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_categories', function (Blueprint $table) {
            $table->dropColumn('class_room_id');
        });
    }
}
