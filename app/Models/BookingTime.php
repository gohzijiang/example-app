<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTime extends Model
{
    protected $fillable = [
        'available_slots', 'time_slot', 'operating_start_time', 'operating_end_time',
    ];
}
