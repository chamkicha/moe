<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Former_manager extends Model
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

    public function school(): BelongsTo
    {

        return $this->belongsTo(Establishing_school::class,'establishing_school_id','id');
    }
}
