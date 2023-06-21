<?php

use App\Models\Combination;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombinationSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combination_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Combination::class,'combination_id')->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Subject::class,'subject_id')->index()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('combination_subjects');
    }
}
