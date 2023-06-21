<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnToTableEstablishingSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishing_schools', function (Blueprint $table) {
            $table->string('school_address')->nullable();
            $table->integer('number_of_students')->nullable();
            $table->string('lessons_and_courses')->nullable();
            $table->integer('number_of_teachers')->nullable();
            $table->string('teacher_student_ratio_recommendation')->nullable();
            $table->longText('teacher_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establishing_schools', function (Blueprint $table) {
            $table->dropColumn('school_address');
            $table->dropColumn('number_of_students');
            $table->dropColumn('lessons_and_courses');
            $table->dropColumn('number_of_teachers');
            $table->dropColumn('teacher_student_ratio_recommendation');
            $table->dropColumn('teacher_information');
        });
    }
}
