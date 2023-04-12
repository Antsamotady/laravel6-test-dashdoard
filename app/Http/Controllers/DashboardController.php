<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard_index');
    }

    public function menu1()
    {
        return view('dashboard_menu1');
    }

    public function menu2()
    {
        return view('dashboard_menu2');
    }

    public function menu2Submenu1()
    {
        return view('dashboard_menu2_submenu1');
    }

    public function menu2Submenu2()
    {
        return view('dashboard_menu2_submenu2');
    }

    public function menu3()
    {
        return view('dashboard_menu3');
    }
}
