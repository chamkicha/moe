<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ownership_sub_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'ownership_type_id',
        'sub_type'
    ];

    public function owner_type(): BelongsTo
    {

        return $this->belongsTo(Ownership_type::class,'ownership_type_id','id');
    }
}
