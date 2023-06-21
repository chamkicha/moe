<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Former_owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'establishing_school_id',
        'tracking_number',
        'owner_name',
        'authorized_person',
        'title',
        'owner_email',
        'phone_number',
        'purpose',
    ];

    public function school(): BelongsTo
    {

        return $this->belongsTo(Establishing_school::class,'establishing_school_id','id');
    }
}
