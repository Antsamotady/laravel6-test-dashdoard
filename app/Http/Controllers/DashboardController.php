<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function menu1()
    {
        return view('dashboard.list');
    }

    public function menu2()
    {
        return view('dashboard.menu2');
    }

    public function menu2Submenu1()
    {
        return view('dashboard.submenu.menu2_submenu1');
    }

    public function menu2Submenu2()
    {
        return view('dashboard.submenu.menu2_submenu2');
    }

    public function menu3(Request $request)
    {
        if($request->ajax()) {
            $output="";

            $output .= '<h1>NEW Menu3</h1>'.
            '<p>Bienvenue sur le new menu3.</p>';
        }
        return Response($output);
    }

}
