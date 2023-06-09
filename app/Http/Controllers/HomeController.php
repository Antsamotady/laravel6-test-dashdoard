<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

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
        $users = User::all();
        $totalUsers = $users->count();
        $totalActifUsers = User::select(DB::raw('count(*) as total_actif_users'))
            ->where('status', '=', 'Actif')
            ->first()
            ->total_actif_users;
        $totalInactifUsers = User::select(DB::raw('count(*) as total_inactif_users'))
            ->where('status', '=', 'Inactif')
            ->first()
            ->total_inactif_users;
        $imageCount = User::whereNotNull('image')->count();

        $groupedUser = User::select(DB::raw('civilite, count(*) as total'))
             ->groupBy('civilite')
             ->get();

        $groupedActifUser = User::select(DB::raw('civilite, count(*) as count'))
             ->where('status', '=', 'Actif')
             ->groupBy('civilite')
             ->get();

        return view('home', [
            'user' => Auth::user(),
            'totalUsers' => $totalUsers,
            'totalActifUsers' => $totalActifUsers,
            'totalInactifUsers' => $totalInactifUsers,
            'imageCount' => $imageCount,
            'groupedUser' => $groupedUser,
            'groupedActifUser' => $groupedActifUser]);
    }

    /**
     * Store new user.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'civilite' => 'bail|required',
            'name' => 'bail|required|between:5,20|alpha',
            'surname' => 'bail|required|between:5,20|alpha',
            'email' => 'bail|required|email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'bail|required|numeric',
            'mobile' => 'bail|required|numeric',
            'avatar-input' => 'file|max:2048|mimes:jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('avatar-input')) {
            $image = $request->file('avatar-input');
            $filename = $image->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $image->move($destinationPath, $filename);
        }

        $user = new \App\User;

        $user->image = $request->input('avatar-hidden-input');
        $user->civilite = $request->civilite;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->password = $request->password;
        $user->status = 'Inactif';

        $user->save();

        return redirect('/home')->with('success', 'Nouvel utilisateur bien enregistré.');
    }

    /**
     * Update user.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'civilite' => 'bail|required',
            'name' => 'bail|required|between:5,20|alpha',
            'surname' => 'bail|required|between:5,20|alpha',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|numeric',
            'mobile' => 'bail|required|numeric',
            'avatar-input' => 'file|max:2048|mimes:jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('avatar-edit-input')) {
            $image = $request->file('avatar-edit-input');
            $filename = $image->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $image->move($destinationPath, $filename);
        }

        $user = \App\User::where('id', $id)->firstOrFail();

        $user->image = $request->input('avatar-hidden-edit-input');
        $user->civilite = $request->civilite;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        
        $user->save();

        return redirect('/home')->with('success', 'Mise à jour réussi.');
    }

    /**
     * Remove user.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/home')->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Toggle user' status.
     */
    public function toggle($id)
    {
        $user = User::find($id);
        $user->status = ($user->status == 'Actif') ? 'Inactif' : 'Actif';
        $user->save();

        $data = ['id' => $id, 'status' => $user->status];

        return response($data, 200)
                    ->header('Content-Type', 'application/json');
    }

}
