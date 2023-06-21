<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
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
        'is_manager',
        'ownership_sub_type_id',
        'denomination_id'
    ];

    public function school(): BelongsTo
    {

        return $this->belongsTo(Establishing_school::class,'establishing_school_id','id');
    }

    public function referees(): HasMany
    {

        return $this->hasMany(Referee::class,'owner_id','id');
    }

    public function ownership(): BelongsTo
    {

        return $this->belongsTo(Ownership_sub_type::class,'ownership_sub_type_id','id');
    }

    public function denomination(): BelongsTo
    {

        return $this->belongsTo(Denomination::class,'denomination_id','denomination_id');
    }
}
