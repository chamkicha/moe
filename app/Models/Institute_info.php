<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institute_info extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'name',
        'registration_number',
        'institute_email',
        'institute_phone',
        'box',
        'ward_id',
        'street',
        'registration_certificate_copy',
        'organizational_constitution',
        'agreement_document',
        'address'
    ];

    public function establish(): BelongsToMany
    {

        return $this->belongsToMany(Establishing_school::class,'school_registries','registry_token','school_token');
    }

    public function applications(): HasMany
    {

        return $this->hasMany(Application::class,'foreign_token','secure_token');
    }

    public function ward(): BelongsTo
    {

        return $this->belongsTo(Ward::class,'ward_id','id');
    }


    public function village(): BelongsTo
    {

        return $this->belongsTo(Street::class, 'street', 'StreetCode');
    }

    public function attachments(): HasMany
    {

        return $this->hasMany(Institute_attachments::class,'institute_info_id','id');
    }
}
