<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute_attachments extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_info_id',
        'attachment_type_id',
        'attachment'
    ];
}
