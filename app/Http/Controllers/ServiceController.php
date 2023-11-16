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

    public function store(Request $request)
    {
        // 在这里处理保存服务的逻辑
        // $request 包含从表单提交的数据
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }
}
