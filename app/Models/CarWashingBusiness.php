<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarWashingBusiness extends Model
{
    protected $fillable = [
        'industrial_lines',
        'dates', // 添加 'dates' 字段
        'open_time',
        'close_time',
    ];
 // 修改为 'dates'，并指定为日期类型
    
}

