<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maoni extends Model
{
    use HasFactory;

    protected $table = "maoni";


    public function staff(): BelongsTo
    {

        return $this->belongsTo(Staffs::class,'id','user_from');
    }
    

}
