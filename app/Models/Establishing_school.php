<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Establishing_school extends Model
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
        'stage',
        'file_number',
        'school_folio',
        'max_folio'
    ];

    public function institute(): BelongsToMany
    {

        return $this->belongsToMany(Institute_info::class,'school_registries','school_token','registry_token');
    }

    public function personal(): BelongsToMany
    {

        return $this->belongsToMany(Personal_info::class,'school_registries','school_token','registry_token');
    }

    public function application(): BelongsTo
    {

        return $this->belongsTo(Application::class,'tracking_number','tracking_number');
    }

    public function ward(): BelongsTo
    {

        return $this->belongsTo(Ward::class, 'ward_id', 'WardCode');
    }

    public function registration_structure(): BelongsTo
    {

        return $this->belongsTo(Registration_structure::class,'registration_structure_id','id');
    }

    public function building_structure(): BelongsTo
    {

        return $this->belongsTo(Building_structure::class,'building_structure_id','id');
    }

    public function owner(): HasOne
    {

        return $this->hasOne(Owner::class,'establishing_school_id','id');
    }

    public function manager(): HasOne
    {

        return $this->hasOne(Manager::class,'establishing_school_id','id');
    }

    public function school(): HasOne
    {

        return $this->hasOne(School_registration::class,'establishing_school_id','id');
    }

    public function category(): BelongsTo
    {
         return $this->belongsTo(School_category::class,'school_category_id','id');
    }

    public function subcategory(): BelongsTo
    {

        return $this->belongsTo(School_sub_category::class,'school_sub_category_id','id');
    }

    public function curriculum(): BelongsTo
    {

        return $this->belongsTo(Curriculum::class,'curriculum_id','id');
    }

    public function language(): BelongsTo
    {

        return $this->belongsTo(Language::class,'language_id','id');
    }

    public function former_combination(): HasMany
    {

        return $this->hasMany(Former_school_combination::class,'establishing_school_id','id');
    }
}
