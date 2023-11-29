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
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
        ]);
    
        // Create a new booking and save it to the database
        $booking = new Booking;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->save();
    
        // Redirect to the booking page with a success message
        return redirect()->route('booking')->with('success', 'Booking saved successfully!');
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
