<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Former_owner_referee extends Model
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
        'address',
        'email',
        'phone_number'
    ];
}
