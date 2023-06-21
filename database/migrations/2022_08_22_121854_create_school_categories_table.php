<?php

use App\Models\Building_structure;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_categories', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->string('category');
            $table->float('uk_msambao')->nullable();
            $table->float('uk_ghorofa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_categories');
    }
}
