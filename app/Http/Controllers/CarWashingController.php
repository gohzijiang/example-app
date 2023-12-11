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
            'dates' => 'required|date_format:Y-m-d',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
        ]); 

          // 添加以下行来调试验证后的数据
          dd($validatedData);

        // 将日期和时间合并到 open_time 和 close_time
        $validatedData['open_time'] = $validatedData['dates'] . ' ' . $validatedData['open_time'];
        $validatedData['close_time'] = $validatedData['dates'] . ' ' . $validatedData['close_time'];
        


        // 现在，您可以创建 CarWashingBusiness 记录
        CarWashingBusiness::create($validatedData);

        return response()->json(['message' => '汽车清洗业务创建成功']);
    }


    public function showBusinessForm()
    {
        return view('admin.CarWashingBusiness');
    }

    public function saveBusiness(Request $request)
    {   
        try {
        $validatedData = $request->validate([
            'industrial_lines' => 'required|integer|min:1|max:4',
            'dates' => 'required|array', // 更改为 array 规则
            'dates.*' => 'date_format:Y-m-d', // 使用日期格式验证，* 表示数组中的每个元素
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
            
        ]); 

        $validatedData['dates'] = explode(',', $validatedData['dates']);
       // 添加以下行来调试验证后的数据
    dd($validatedData);
} catch (\Exception $e) {
    // 输出异常消息
    dd($e->getMessage());
}
        // 迭代日期数组
        foreach ($validatedData['dates'] as $date) {
            // 将日期和时间合并为 DateTime 对象
            $startTime = new \DateTime($date . ' ' . $validatedData['open_time']);
            $endTime = new \DateTime($date . ' ' . $validatedData['close_time']);

            // 添加额外的验证逻辑，确保开始时间早于结束时间等等（根据你的需求进行调整）
            if ($endTime <= $startTime) {
                return redirect()->route('businessForm')->with('error', '结束时间必须晚于开始时间！');
            }
    
            // 创建或更新数据库记录
            $existingRecord = CarWashingBusiness::where('dates', $date)->first();

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
                    'dates' => $date,
                    'industrial_lines' => $validatedData['industrial_lines'],
                    'open_time' => $validatedData['open_time'],
                    'close_time' => $validatedData['close_time'],
                ]);
            }
        }
    
        return redirect()->route('businessForm')->with('success', 'Business setup saved successfully!');
    }
    
    
    public function getAvailableIndustrialLines($date)
    {
        $availableLines = CarWashingBusiness::where('date', $date)->count();

        return response()->json(['availableLines' => $availableLines]);
    }

    
}
