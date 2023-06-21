<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_registry extends Model
{
    use HasFactory;

    protected $fillable = ['school_token','registry_token'];
}
