<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'uploader_token',
        'tracking_number',
        'attachment_path',
        'attachment_type_id'
    ];

    public function attachment_type(): BelongsTo
    {
        return $this->belongsTo(Attachment_type::class,'attachment_type_id','id');
    }
}
