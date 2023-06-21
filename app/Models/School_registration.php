<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class School_registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'establishing_school_id',
        'tracking_number',
        'school_opening_date',
        'level_of_education',
        'is_seminary',
        'registration_number'
    ];

    public function school(): BelongsTo
    {

        return $this->belongsTo(Establishing_school::class,'establishing_school_id','id');
    }

    public function combination(): HasMany
    {

        return $this->hasMany(School_combination::class,'school_registration_id','id');
    }

    public function education_level(): BelongsTo
    {

        return $this->belongsTo(Certificate_type::class,'level_of_education','id');
    }

    public function detours(): HasMany
    {

        return $this->hasMany(School_detour::class,'school_registration_id','id');
    }
}
