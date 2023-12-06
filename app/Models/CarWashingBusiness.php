<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarWashingBusiness extends Model
{
    protected $fillable = [
        'industrial_lines',
        'open_time',
        'close_time',
        'date',        // 添加 'date' 字段
    ];
}

