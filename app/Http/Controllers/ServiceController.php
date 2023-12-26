<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{

    public function create()
    {
        return view('admin.insertService');
    }

    public function index()
{
    // 获取所有服务
    $services = Service::all();

    // 将服务数据传递给视图
    return view('admin.service', compact('services'));

}


    public function store(Request $request)
{
    // 在这里处理保存服务的逻辑
    // $request 包含从表单提交的数据
    $validatedData = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'duration' => 'required|integer',
    ]);

    \Log::info('Attempting to create service', $validatedData);

    $service = Service::create($validatedData);

    \Log::info('Service created successfully:', $service->toArray());

    return redirect()->route('services.index')->with('success', 'Service created successfully!');
}
    
}
