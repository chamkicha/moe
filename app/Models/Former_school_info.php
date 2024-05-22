<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Former_school_info extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'registry_type_id',
        'school_category_id',
        'school_sub_category_id',
        'school_name',
        'school_phone',
        'school_email',
        'school_size',
        'area',
        'stream',
        'website',
        'language_id',
        'building_structure_id',
        'school_gender_type_id',
        'school_specialization_id',
        'region_id',
        'district_id',
        'ward_id',
        'village_id',
        'registration_structure_id',
        'curriculum_id',
        'certificate_type_id',
        'sect_name_id',
        'tracking_number',
        'number_of_students',
        'lessons_and_courses',
        'number_of_teachers',
        'teacher_student_ratio_recommendation',
        'teacher_information',
        'po_box',
        'school_address',
        'establishing_school_id',
        'tracking_number',
        'is_hostel'
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(Establishing_school::class,'establishing_school_id','id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(School_category::class,'school_category_id','id');
    }

    public function subcategory(): BelongsTo
    {

        return $this->belongsTo(School_sub_category::class,'school_sub_category_id','id');
    }
}
