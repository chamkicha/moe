<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Former_school_combination extends Model
{
    use HasFactory;

    protected $fillable = [
        'establishing_school_id',
        'combination_id',
        'tracking_number'
    ];

    public function school(): BelongsTo
    {

        return $this->belongsTo(Establishing_school::class,'establishing_school_id','id');
    }

    public function combination(): BelongsTo
    {

        return $this->belongsTo(Combination::class,'combination_id','id');
    }
}
