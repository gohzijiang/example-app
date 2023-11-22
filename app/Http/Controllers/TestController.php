<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // 这里可以添加获取数据的逻辑，例如从数据库中获取所有测试数据
        $tests = Test::all();

        // 返回视图，并将数据传递给视图
        return view('test.index', ['tests' => $tests]);
    }

    public function create()
    {
        // 返回创建资源的表单页面
        return view('test.tryStore');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'age' => 'required|integer',
        ]);

        Test::create($validatedData);

        return redirect()->route('test.index')->with('success', 'Data stored successfully!');
    }
}

