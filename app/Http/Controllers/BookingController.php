<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    // 在 BookingController 中
public function create()
{
    // 返回预订表单页面
}

public function store(Request $request)
{
    // 处理保存预订的逻辑
}

public function show(Booking $booking)
{
    // 显示预订详情
}

public function index()
{
    // 显示预订列表
}

}
