<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'booking_datetime',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'note',
        'total_price',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
