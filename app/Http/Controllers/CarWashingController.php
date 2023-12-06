<?php

namespace App\Http\Controllers;
use App\Models\CarWashingBusiness;
use Illuminate\Http\Request;
// 设置admin industrial line 等。。
class CarWashingController extends Controller
{
    public function createBusiness(Request $request)
    {
        $validatedData = $request->validate([
            'industrial_lines' => 'required|integer',
            'date' => 'required|date_format:Y-m-d',
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
            'date' => 'required|date_format:Y-m-d',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);
    
        // 将日期和时间合并为 DateTime 对象
        $startTime = new \DateTime($validatedData['date'] . ' ' . $validatedData['open_time']);
        $endTime = new \DateTime($validatedData['date'] . ' ' . $validatedData['close_time']);
    
        // 添加额外的验证逻辑，确保开始时间早于结束时间等等（根据你的需求进行调整）
    

    
       // 创建或更新数据库记录
       $date = $validatedData['date'];

       // 检查数据库中是否已存在相同日期的记录
       $existingRecord = CarWashingBusiness::where('date', $date)->first();
       
       if ($existingRecord) {
           // 如果存在，执行更新，包括 'industrial_lines'
           $existingRecord->update([
               'industrial_lines' => $validatedData['industrial_lines'],
               'open_time' => $validatedData['open_time'],
               'close_time' => $validatedData['close_time'],
           ]);
       } else {
           // 如果不存在，执行创建
           CarWashingBusiness::create([
               'date' => $date,
               'industrial_lines' => $validatedData['industrial_lines'],
               'open_time' => $validatedData['open_time'],
               'close_time' => $validatedData['close_time'],
           ]);
       }

    
        return redirect()->route('businessForm')->with('success', 'Business setup saved successfully!');
    }
    
    public function getAvailableIndustrialLines($date)
    {
        $availableLines = CarWashingBusiness::where('date', $date)->count();

        return response()->json(['availableLines' => $availableLines]);
    }

    
}
