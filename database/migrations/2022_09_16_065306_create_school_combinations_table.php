<?php

use App\Models\Combination;
use App\Models\School_registration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_combinations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School_registration::class,'school_registration_id')->nullable()->index()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('school_combinations');
    }
}
