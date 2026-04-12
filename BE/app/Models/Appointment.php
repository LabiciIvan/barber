<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'barber_id',
        'customer_id',
        'customer_name',
        'customer_phone',
        'start_time',
        'end_time',
        'status',
        'total_price',
    ];

    public function barber(): BelongsTo {
        return $this->belongsTo(User::class, 'barber_id');
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function services(): BelongsToMany {
        return $this->belongsToMany(Service::class, 'appointment_service', 'appointment_id', 'service_id')->withPivot(['price_at_booking', 'duration_minutes_at_booking']);
    }

}
