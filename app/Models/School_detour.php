<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class School_detour extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_registration_id',
        'school_specialization_id'
    ];

    public function registration(): BelongsTo
    {

        return $this->belongsTo(School_registration::class);
    }

    public function specialization(): BelongsTo
    {

        return $this->belongsTo(School_specialization::class,'school_specialization_id','id');
    }
}
