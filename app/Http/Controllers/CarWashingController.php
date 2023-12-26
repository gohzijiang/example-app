<?php

namespace App\Http\Controllers;

use App\Models\CarWashingBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class CarWashingController extends Controller
{
    // 创建业务记录
    public function createBusiness(Request $request)
    {
        try {
            // 验证请求数据
            $validatedData = $request->validate([
                'industrial_lines' => 'required|integer|min:1|max:4',
                'dates' => 'required|array',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i|after:open_time',
            ]);
            $datesString = $validatedData['dates'];
           // $dates = explode(',', $datesString);
          
            $businessData = [];
    
            // 创建 CarWashingBusiness 记录
            foreach ($datesArray as $date) {
                // 存储数据到 $businessData 数组
                $businessData[] = [
                    'industrial_lines' => $validatedData['industrial_lines'],
                    'dates' => $date,
                    'open_time' => $validatedData['open_time'],
                    'close_time' => $validatedData['close_time'],
                ];
    
                CarWashingBusiness::create([
                    'industrial_lines' => $validatedData['industrial_lines'],
                    'dates' => $date,
                    'open_time' => $validatedData['open_time'],
                    'close_time' => $validatedData['close_time'],
                ]);
            }
    
            // 输出所有日期的详细数据
            dd($businessData);
    
            return response()->json(['message' => '汽车清洗业务创建成功']);
        } catch (\Exception $e) {
            // 输出异常消息
            dd($e->getMessage(), $request->all());
        }
    }

    public function saveBusiness(Request $request)
    {
        try {
            // 验证请求数据
            $validatedData = $request->validate([
                'industrial_lines' => 'required|integer|min:1|max:4',
                'dates' => 'required|string',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i|after:open_time',
            ]);
            
         //   $dates = explode(',', $datesString);
            $datesArray = array_unique(array_map('trim', explode(',', $validatedData['dates'])));
            // 遍历日期数组，创建或更新 CarWashingBusiness 记录
           foreach ($datesArray as $date) {
            // 使用 Carbon 创建日期对象并格式化为字符串
            $formattedDate = Carbon::parse($date)->toDateString();

            // 查找现有记录
            $existingRecord = CarWashingBusiness::where([
                'dates' => Carbon::parse($formattedDate)->toDateString(),
            ])->first();
                if ($existingRecord) {
                    $existingRecord->update([
                        'industrial_lines' => $validatedData['industrial_lines'],
                        'open_time' => $validatedData['open_time'],
                        'close_time' => $validatedData['close_time'],
                    ]);
            } else {
                CarWashingBusiness::create([
                    'industrial_lines' => $validatedData['industrial_lines'],
                    'dates' => $formattedDate,
                    'open_time' => $validatedData['open_time'],
                    'close_time' => $validatedData['close_time'],
                ]);
            }
        }
        

            // 其他逻辑...

            return redirect()->route('businessForm')->with('success', 'Business setup saved successfully!');
        } catch (\Exception $e) {
            // 输出异常消息
            dd($e->getMessage(), $request->all());
        }
    }

    // 其他方法...

    public function showBusinessForm()
    {
        return view('admin.CarWashingBusiness');
    }

    
    public function getAvailableIndustrialLines($selectedDate)
{

  
    // 查询数据库，获取选择日期的工业线数量
    $lines = CarWashingBusiness::where('dates', $selectedDate)->value('industrial_lines');  
    // 返回 JSON 响应
    return response()->json(['availableLines' => $lines]);
}

    public function getCarWashingInfo($selectedDate)
    {
        // 查询数据库，获取选择日期的 CarWashingBusiness 信息
        $businessInfo = CarWashingBusiness::where('dates', $selectedDate)->first();

        // 返回 Blade 视图
        return view('car_washing_info', ['businessInfo' => $businessInfo]);
    }

    public function getOpenCloseTime(Request $request)
    {
        $selectedDate = $request->input('selected_date');
        
        // 在这里查询数据库，获取选定日期的开放和关闭时间
        $timeInfo = YourModel::where('dates', $selectedDate)->first(['open_time', 'close_time']);

        return response()->json($timeInfo);
    }
}
