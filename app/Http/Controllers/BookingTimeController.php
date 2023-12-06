<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingTime;
class BookingTimeController extends Controller
{
    public function index()
    {
        $bookingTimes = BookingTime::all();
        return view('booking_times.index', compact('bookingTimes'));
    }

    public function create()
    {
        return view('booking_times.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'available_slots' => 'required|integer',
            'time_slot' => 'required|date_format:H:i',
            'operating_start_time' => 'required|date_format:H:i',
            'operating_end_time' => 'required|date_format:H:i|after:operating_start_time',
        ]);

        BookingTime::create($request->all());

        return redirect()->route('booking_times.index')->with('success', 'Booking time created successfully.');
    }

}
