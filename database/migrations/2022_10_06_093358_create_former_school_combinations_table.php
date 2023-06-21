<?php

use App\Models\Combination;
use App\Models\Establishing_school;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormerSchoolCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('former_school_combinations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Establishing_school::class,'establishing_school_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Combination::class,'combination_id')->nullable()->index()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('former_school_combitionations');
    }
}
