<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // 如果 $user->is_admin 等于 1 或者 $user->role 等于 'admin'
        if ($user->is_admin == 1 || $user->role == 'admin') {
            return view('admin_dashboard');
        } else {
            return view('user_dashboard');
        }
    }
}


