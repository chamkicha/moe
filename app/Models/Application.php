<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'secure_token',
        'user_id',
        'foreign_token',
        'application_category_id',
        'tracking_number',
        'registry_type_id',
        'control_number',
        'payment_status_id',
        'amount',
        'expire_date',
        'folio',
        'is_complete'
    ];

    public function personal(): BelongsTo
    {

        return $this->belongsTo(Personal_info::class,'foreign_token','secure_token');
    }

    public function institute(): BelongsTo
    {

        return $this->belongsTo(Institute_info::class,'foreign_token','secure_token');
    }

    public function category(): BelongsTo
    {

        return $this->belongsTo(Application_category::class,'application_category_id');
    }

    public function applicant_type(): BelongsTo
    {

        return $this->belongsTo(Registry_type::class,'registry_type_id','id');
    }

    public function establishing(): HasOne
    {

        return $this->hasOne(Establishing_school::class,'tracking_number','tracking_number');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class,'tracking_number','tracking_number');
    }

    public function owner(): BelongsTo
    {

        return $this->belongsTo(Owner::class,'tracking_number','tracking_number');
    }

    public function registration(): BelongsTo
    {

        return $this->belongsTo(School_registration::class,'tracking_number','tracking_number');
    }

    public function combination(): HasMany
    {

        return $this->hasMany(School_combination::class,'school_registration_id','id');
    }

    public function payment_status(): BelongsTo
    {

        return $this->belongsTo(Payment_status::class,'payment_status_id','id');
    }

    public function former_school(): HasOne
    {
        return $this->hasOne(Former_school_info::class,'tracking_number','tracking_number');
    }

    public function former_combination(): HasOne
    {

        return $this->hasOne(Former_school_combination::class,'tracking_number','tracking_number');
    }

    public function former_manager(): HasOne
    {

        return $this->hasOne(Former_manager::class,'tracking_number','tracking_number');
    }

    public function former_owner(): HasOne
    {

        return $this->hasOne(Former_owner::class,'tracking_number','tracking_number');
    }

    public function maoni(): HasOne
    {

        return $this->hasOne(Maoni::class,'trackingNo','tracking_number');
    }
}
