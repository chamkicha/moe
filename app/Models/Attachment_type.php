<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment_type extends Model
{
    use HasFactory;

    protected $fillable = ['secure_token','registry_type_id','attachment_name'];
}
