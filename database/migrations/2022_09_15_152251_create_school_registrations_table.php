<?php

use App\Models\Class_room;
use App\Models\Establishing_school;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->foreignIdFor(Establishing_school::class,'establishing_school_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('tracking_number')->nullable();
            $table->date('school_opening_date')->nullable();
            $table->unsignedBigInteger('level_of_education')->nullable()->index();
            $table->foreign('level_of_education')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->boolean('is_seminary')->default(false);
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
        Schema::dropIfExists('school_registrations');
    }
}
