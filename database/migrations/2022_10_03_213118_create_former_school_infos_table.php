<?php

use App\Models\Building_structure;
use App\Models\Certificate_type;
use App\Models\Curriculum;
use App\Models\Establishing_school;
use App\Models\Language;
use App\Models\Registration_structure;
use App\Models\School_category;
use App\Models\School_gender_type;
use App\Models\School_specialization;
use App\Models\School_sub_category;
use App\Models\Sect_name;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormerSchoolInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('former_school_infos', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->string('tracking_number')->nullable();
            $table->foreignIdFor(Establishing_school::class,'establishing_school_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(School_category::class,'school_category_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(School_sub_category::class,'school_sub_category_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('school_name')->nullable();
            $table->string('school_phone')->nullable();
            $table->string('school_email')->nullable();
            $table->float('school_size')->nullable();
            $table->float('area')->nullable();
            $table->integer('stream')->nullable();
            $table->string('website')->nullable();
            $table->foreignIdFor(Language::class,'language_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Building_structure::class,'building_structure_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(School_gender_type::class,'school_gender_type_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(School_specialization::class,'school_specialization_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Ward::class,'ward_id')->index()->nullable();
            $table->foreignIdFor(Registration_structure::class,'registration_structure_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Curriculum::class,'curriculum_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Certificate_type::class,'certificate_type_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Sect_name::class,'sect_name_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->boolean('is_for_disabled')->default(false);
            $table->boolean('is_hostel')->default(false);
            $table->string('school_address')->nullable();
            $table->integer('number_of_students')->nullable();
            $table->string('lessons_and_courses')->nullable();
            $table->integer('number_of_teachers')->nullable();
            $table->string('teacher_student_ratio_recommendation')->nullable();
            $table->longText('teacher_information')->nullable();
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
        Schema::dropIfExists('former_school_infos');
    }
}
