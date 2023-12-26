<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
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
        'name' => 'required',
        'phone_number' => 'required',
        'address' => 'required|email', // Update the validation rule for email
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
    $booking->name = $request->name; // Update to use the 'name' field
    $booking->phone_number = $request->phone_number;
    $booking->address = $request->address;
    $booking->note = $request->note;
    $booking->total_price = $totalPrice; // 使用计算出的 total_price
    $booking->userID = auth()->id(); // 使用当前用户的 ID
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
    $bookings = Booking::all(); // 假设你的模型是 Booking
    

    return view('admin.index', compact('bookings'));
}


public function getServiceInfo($serviceId)
{
    // 查询数据库，获取选择服务的相关信息
    $service = Service::find($serviceId);

    // 返回服务信息
    return response()->json($service);
}

public function userIndex()
{
    // 获取当前登录用户信息
    $user = Auth::user();

    // 获取该用户的服务
    $userServices = Service::where('    ', $user->id)->get();

    // 获取用户的预订信息
    $userBookings = Booking::where('user_id', $user->id)->get();

    // 将数据传递到视图
    return view('user.index', ['userServices' => $userServices, 'userBookings' => $userBookings]);
}

}
