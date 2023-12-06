<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    if ($user->is_admin || $user->role == 'admin') {
        return view('admin_dashboard');
    } else {
        return view('user_dashboard');
    }
}

    
}