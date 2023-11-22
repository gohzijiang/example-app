<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('service.index', compact('services'));
    }

    public function create()
    {
        return view('create_service');
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

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }
    
}
