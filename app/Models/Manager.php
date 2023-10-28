<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'establishing_school_id',
        'tracking_number',
        'manager_first_name',
        'manager_middle_name',
        'manager_last_name',
        'occupation',
        'ward_id',
        'house_number',
        'street',
        'manager_phone_number',
        'manager_email',
        'education_level',
        'expertise_level',
        'manager_certificate',
        'manager_cv'
    ];

    public function ward(): BelongsTo
    {

        return $this->belongsTo(Ward::class,'ward_id','id');
    }



    public function village(): BelongsTo
    {

        return $this->belongsTo(Street::class, 'street', 'StreetCode');
    }
}
