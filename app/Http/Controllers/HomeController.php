<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Store new user.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|between:5,20|alpha',
            'surname' => 'bail|required|between:5,20|alpha',
            'email' => 'bail|required|email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'bail|required|numeric',
            'mobile' => 'bail|required|numeric'
        ]);
        
        $user = new \App\User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->password = $request->password;

        $user->save();

        return view('home');
    }

    /**
     * Store new user.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return view('home');
    }

}
