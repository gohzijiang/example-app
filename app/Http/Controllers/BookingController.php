<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use Stripe;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        'email' => 'required|email', // 将验证规则更改为 email
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
    $booking->name = $request->name; // 这里
    $booking->phone_number = $request->phone_number; // 这里
    $booking->email = $request->email; // 这里
    $booking->note = $request->note;
    $booking->total_price = $totalPrice;
    $booking->user_id = auth()->id();
    $booking->save();


    // 重定向到 booking.details 路由，并传递预订的 ID
    $bookings = $this->getTodayBookings();

    return redirect()->route('booking.details', ['booking' => $booking->id]);
}


// 调试，查看请求的所有数据

    // 重定向到 booking.details 路由，并传递预订的 ID
   // return redirect()->route('booking.details', ['booking' => $booking->id]);


public function showDetails(Booking $booking)
{
    return view('user.bookingDetails', ['booking' => $booking]);
}



public function index()
{
    $bookings = $this->getTodayBookings();

    return view('admin.index', compact('bookings'));
}

private function getTodayBookings()
{
    $bookings = now()->toDateString();

    // 查询数据库，找到匹配日期的预订
    $bookings = Booking::whereDate('booking_datetime', $bookings)->get();

    return $bookings;
}

public function getServiceInfo($serviceId)
{
    // 查询数据库，获取选择服务的相关信息
    $service = Service::find($serviceId);

    // 返回服务信息
    return response()->json($service);
}

public function getBookedSlots(Request $request, $date)
{
    // 将传入的日期字符串转换为 Carbon 实例
    $selectedDate = Carbon::parse($date);

    // 获取指定日期的预订数据，包括 booking_datetime 和 service_id
    $bookedSlots = Booking::select('booking_datetime', 'service_id')
        ->with('service') // 加载 service 关联
        ->whereDate('booking_datetime', $selectedDate->toDateString())
        ->get();

    // 从关联的服务中获取 duration 字段
    $bookedSlots->transform(function ($booking) {
        $booking->duration = optional($booking->service)->duration;
        return $booking;
    });

    return response()->json($bookedSlots);
}


public function userIndex()
{
    // 获取当前登录用户信息
    $user = Auth::user();

    // 获取该用户的服务

    // 获取用户的预订信息
    $userBookings = Booking::where('user_id', $user->id)->get();

    // 将数据传递到视图
    return view('user.userIndex', ['bookings' => $userBookings]);
}

public function searchByUserName(Request $request)
    {
        $searchByUserName  = $request->input('searchByUserName');
        $bookings = Booking::with('user')->whereHas('user', function ($query) use ($searchByUserName) {
            $query->where('name', 'like', '%' . $searchByUserName . '%');
        })->get();

        return view('admin.index', compact('searchByUserName', 'bookings'));
    }

    public function searchByDateTime(Request $request)
    {
        $searchDate = $request->input('searchByDateTime');
    
        // 使用 Carbon 对象来处理日期格式
        $searchDate = Carbon::parse($searchDate);
    
        // 查询数据库，找到匹配日期的预订
        $bookings = Booking::whereDate('booking_datetime', $searchDate)->get();
    
        return view('admin.index', ['searchByDateTime' => $searchDate, 'bookings' => $bookings]);
    }
    public function searchByUserNameAndDateTime(Request $request)
    {
        $searchByUserName = $request->input('searchByUserName');
        $searchByDateTime = $request->input('searchByDateTime');
    
        // 如果没有提供完整信息，返回 JSON 响应
        if (!$searchByUserName || !$searchByDateTime) {
            return response()->json(['error' => 'Please insert complete information']);
        }
    
        // 使用 Carbon 对象来处理日期格式
        $searchDate = Carbon::parse($searchByDateTime);
    
        // 查询数据库，找到匹配用户名和日期的预订
        $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
            ->where('users.name', $searchByUserName)
            ->whereDate('bookings.booking_datetime', $searchDate)
            ->get();
    
        // 如果没有找到匹配的记录，返回 JSON 响应
        if ($bookings->isEmpty()) {
            return redirect()->route('bookings.index')->with('error', 'This user has no booking for ' . $searchDate->toDateString());
        }
    
        // 找到记录时，返回视图
        return view('admin.index', [
            
            'searchByUserName' => $searchByUserName,
            'searchByDateTime' => $searchDate,
            'bookings' => $bookings,
        ]);
    }

    public function userSearchBusinessByDates(Request $request)
{
    // 获取当前认证用户的ID
    $userId = Auth::id(); // 获取当前用户的 ID


    // 获取用户选择的日期
    $searchDate = $request->input('UserSearchByDateTime');

    // 使用 Carbon 对象来处理日期格式
    $searchDate = Carbon::parse($searchDate);

    // 查询数据库，找到匹配日期的预订
    $bookings = Booking::where('user_id', $userId)
        ->whereDate('booking_datetime', $searchDate)
        ->get();

    return view('user.userIndex', ['UserSearchByDateTime' => $searchDate, 'bookings' => $bookings]);
}

public function paymentPost(Request $request)
{
Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    Stripe\Charge::create ([
            "amount" => $request->total_price * 100,   // RM10  10=10 cen 10*100=1000 cen
            "currency" => "MYR",
            "source" => $request->stripeToken,
            "description" => "This payment is testing purpose of southern online",
    ]);
    $user = Auth::user();
    $userBookings = Booking::where('user_id', $user->id)->get();

    // 将数据传递到视图
    return view('user.userIndex', ['bookings' => $userBookings]);  

}






}
