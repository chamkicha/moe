<?php

use App\Models\School_registration;
use App\Models\School_specialization;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_detours', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(School_registration::class,'school_registration_id')->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(School_specialization::class,'school_specialization_id')->index()->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('school_detours');
    }
}
