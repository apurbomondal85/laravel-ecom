<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.pages.landing.index');
    }

    public function dashboard()
    {
        return view('public.user_dashboard.dashboard');
    }
}
