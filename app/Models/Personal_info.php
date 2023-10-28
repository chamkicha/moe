<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Personal_info extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'first_name',
        'middle_name',
        'last_name',
        'occupation',
        'personal_email',
        'personal_phone_number',
        'identity_type_id',
        'personal_id_number',
        'personal_address',
        'ward_id'
    ];

    public function identity_type(): BelongsTo
    {

        return $this->belongsTo(Identity_type::class,'identity_type_id','id');
    }

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

        return $this->belongsTo(Ward::class,'ward_id','WardCode');
    }
}
