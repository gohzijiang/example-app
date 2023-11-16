<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->is_admin) {
            return View::make('admin_dashboard');
        } else {
            return View::make('user_dashboard');
        }
    }
    
}