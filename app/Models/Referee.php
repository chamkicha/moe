<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referee extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'first_name',
        'middle_name',
        'last_name',
        'occupation',
        'owner_id',
        'ward_id',
        'village_id',
        'address',
        'email',
        'phone_number'
    ];

    public function ward(): BelongsTo
    {

        return $this->belongsTo(Ward::class,'ward_id','id');
    }



    public function village(): BelongsTo
    {

        return $this->belongsTo(Street::class, 'village_id', 'StreetCode');
    }
}
