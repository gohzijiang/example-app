<?php

namespace App\Http\Controllers;
use App\Models\CarWashingBusiness;
use Illuminate\Http\Request;

class CarWashingController extends Controller
{
    public function createBusiness(Request $request)
    {
        $validatedData = $request->validate([
            'industrial_lines' => 'required|integer',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
        ]);

        CarWashingBusiness::create($validatedData);

        return response()->json(['message' => 'Car washing business created successfully']);
    }

    public function showBusinessForm()
    {
        return view('admin.CarWashingBusiness');
    }

    public function saveBusiness(Request $request)
    {
        $validatedData = $request->validate([
            'industrial_lines' => 'required|integer|min:1|max:4',
            'open_time' => 'required|before:close_time',
            'close_time' => 'required|after:open_time|before:20:00',
        ]);

        // 创建或更新数据库记录
        CarWashingBusiness::updateOrCreate([], $validatedData);

        return redirect()->route('businessForm')->with('success', 'Business setup saved successfully!');
    }

    
}
