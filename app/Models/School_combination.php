<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class School_combination extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_registration_id',
        'combination_id'
    ];

    public function school(): BelongsTo
    {

        return $this->belongsTo(School_registration::class,'school_registration_id','id');
    }

    public function combination(): BelongsTo
    {

        return $this->belongsTo(Combination::class,'combination_id','id');
    }
}
