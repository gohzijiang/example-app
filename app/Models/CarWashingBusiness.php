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
        'dates', // 添加 'dates' 字段
    ];

    protected $dates = ['dates']; // 修改为 'dates'，并指定为日期类型

    protected $casts = [
        'dates' => 'array',
    ];

}

