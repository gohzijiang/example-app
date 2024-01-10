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

    public function getOpenCloseTime($selectedDate)
    {
    
        // 查询数据库以获取选定日期的开放和关闭时间
        $DateInfo = CarWashingBusiness::where('dates', $selectedDate)->first(['open_time', 'close_time']);
        // 添加检查以确保 $timeInfo 不为 null
        if ($DateInfo) {
            // 返回 JSON 格式的数据，确保是一个数组
           
            return response()->json([
                'open_time' => $DateInfo->open_time,
                'close_time' => $DateInfo->close_time,
            ]);
        } else {
            // 如果没有匹配的记录，可以返回一个适当的响应，例如：
            return response()->json(['error' => 'No record found for the selected date'], 404);
        }
    }
    public function index()
    {
        // 获取当前月份
        $currentMonth = now()->format('m');

        // 查询数据库获取当前月份的业务信息
        $businessData = CarWashingBusiness::whereMonth('dates', $currentMonth)
            ->get();

        // 返回视图，并将业务信息传递给视图
        return view('admin.BusinessIndex', ['businessData' => $businessData]);
    }

    public function searchBusinessByMonth(Request $request)
{
    $searchBusinessByMonth = $request->input('searchBusinessByMonth');

    $businessData = CarWashingBusiness::whereMonth('dates', $searchBusinessByMonth)
            ->get();
            if ($businessData->isEmpty()) {
                return redirect()->route('BusinessIndex')->with('error', 'Select month haven`t setting for online booking ');
            }
    // 返回视图，并将业务信息传递给视图
    return view('admin.BusinessIndex', ['businessData' => $businessData]);
}

public function searchBusinessByDates(Request $request)
{
    $searchBusinessByDate = $request->input('searchByDate');

    $businessData = CarWashingBusiness::whereDate('dates', $searchBusinessByDate)
        ->get();

    if ($businessData->isEmpty()) {
        return redirect()->route('BusinessIndex')->with('error', 'No business setting for the selected date');
    }

    return view('admin.BusinessIndex', ['businessData' => $businessData]);
}

}
