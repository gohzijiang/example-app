<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;

// user booking 页面
class BookingController extends Controller
{
    // 在 BookingController 中
public function create()
{
    // 返回预订表单页面
    $services = Service::all();

    $openTime = "08:00";
    $closeTime = "19:00";
     // 存储这些值到 session
     session(['openTime' => $openTime, 'closeTime' => $closeTime]);
    return view('user.booking', compact('services'));
}


public function store(Request $request)
{
    // 验证请求数据
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'booking_datetime' => 'required|date',
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'note' => 'nullable',
    ]);

    // 获取所选择的服务
    $selectedService = Service::findOrFail($request->service_id);

    // 计算 total_price
    $totalPrice = $selectedService->price;

    // 创建一个新的预订并保存到数据库
    $booking = new Booking;
    $booking->service_id = $request->service_id;
    $booking->booking_datetime = $request->booking_datetime;
    $booking->first_name = $request->first_name;
    $booking->last_name = $request->last_name;
    $booking->phone_number = $request->phone_number;
    $booking->address = $request->address;
    $booking->note = $request->note;
    $booking->total_price = $totalPrice; // 使用计算出的 total_price
    $booking->save();

    // 重定向到 booking.details 路由，并传递预订的 ID
    return redirect()->route('booking.details', ['booking' => $booking->id]);
}


public function showDetails(Booking $booking)
{
    return view('user.bookingDetails', ['booking' => $booking]);
}



public function index()
{
    // 显示预订列表
}

}
