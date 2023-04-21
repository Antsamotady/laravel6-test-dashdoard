<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
     * Show list of users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list()
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

        return view('dashboard.list', [
            'user' => Auth::user(),
            'totalUsers' => $totalUsers,
            'totalActifUsers' => $totalActifUsers,
            'totalInactifUsers' => $totalInactifUsers,
            'imageCount' => $imageCount,
            'groupedUser' => $groupedUser,
            'groupedActifUser' => $groupedActifUser]);
    }

    public function search(Request $request)
    {
        $loggeduser = Auth::user();

        if($request->ajax()) {
            $output="";

            if($request->name && $request->status && $request->status!='Tous')
                $users=DB::table('users')
                    ->where('name','LIKE','%'.$request->name.'%')
                    ->where('status','LIKE', $request->status)
                    ->get();
            if($request->name && (is_null($request->status) || $request->status=='Tous'))
                $users=DB::table('users')
                    ->where('name','LIKE','%'.$request->name.'%')
                    ->get();
            if(is_null($request->name) && $request->status && $request->status!='Tous')
                $users=DB::table('users')
                    ->where('status','LIKE', $request->status)
                    ->get();
            if(is_null($request->name) && (is_null($request->status) || $request->status=='Tous'))
                $users=DB::table('users')
                    ->get();

            if($users){
                foreach ($users as $key => $user) {
                    $createDate = str_replace('-', '/', substr($user->created_at, 0, -9));

                    if($user->status=='Actif') {
                        $status = '<span id="toggle-status-txt-'.$user->id.'" class="font-weight-bolder" style="color: #5cb85c;">ACTIF</span>';
                        $switchBtn = '<div class="col-6 toggle-status" id="toggle-status-btn-'.$user->id.'-'.$user->status.'" data-action="/dashboard/toggle/'.$user->id.'"><div class="button-toggle b2" id="switch-status-btn"><input type="checkbox" class="checkbox" /><div class="knobs"><span></span></div><div class="layer"></div></div></div>';
                    } else {
                        $status = '<span id="toggle-status-txt-'.$user->id.'" class="font-weight-bolder" style="color: #fe794e;">INACTIF</span>';
                        $switchBtn = '<div class="col-6 toggle-status" id="toggle-status-btn-'.$user->id.'-'.$user->status.'" data-action="/dashboard/toggle/'.$user->id.'"><div class="button-toggle b2" id="switch-status-btn"><input type="checkbox" class="checkbox" checked/><div class="knobs"><span></span></div><div class="layer"></div></div></div>';
                    }

                    if($user->password != $loggeduser->getAuthPassword())
                        $delButton = '<button data-toggle="modal" data-backdrop="static" data-target="#modalConfirmDel" type="submit" class="btn btn-warning col-12 delUser" id="'.$user->id.'">Supprimer</button>';
                    else
                        $delButton = '';

                    if(!$user->image)
                        if($user->civilite == 'Mr')
                            $avatar = 'profil-homme.jpg';
                        else $avatar = 'profil-femme.png';
                    else
                        $avatar = $user->image;


                    $output.='<div class="card mt-2">'.
                            '<div class="card-body">'.
                                '<form class="row row-cols-lg-auto g-3">'.
                                    '<div class="col-2"><img class="ml-4" id="avatar-image-list" src="../images/'.$avatar.'" alt="Avatar"></div>'.
                                    '<div class="col-2"><p><strong>'.$user->surname.' '.$user->name.'</strong></p></div>'.
                                    '<div class="col-3">'.
                                        '<div class="row mb-4">'.
                                        $switchBtn.$status.'</div>'.
                                        '<div class="col-12">Date de création du compte : '.$createDate.'</div>'.
                                    '</div>'.
                                    '<div class="col-3">'.
                                        '<div class="col-12 text-primary d-flex align-items-center mb-2"><span class="material-icons md-18">mail</span>&nbsp;'.$user->email.'</div>'.
                                        '<div class="col-12 d-flex align-items-center mb-2"><span class="material-icons md-18">phone</span>&nbsp;'.$user->phone.'</div>'.
                                        '<div class="col-12 d-flex align-items-center mb-2"><span class="material-icons md-18">smartphone</span>&nbsp;'.$user->mobile.'</div>'.
                                    '</div>'.
                                    '<div class="col-2">'.
                                        '<button data-toggle="modal" data-backdrop="static" data-target="#modalEditUser" type="submit" class="btn btn-primary mb-4 col-12 editUser" id="'.
                                            $user->id.'" civilite="'.
                                            $user->civilite.'" avatar="'.
                                            $user->image.'" nom="'.
                                            $user->name.'" surname="'.
                                            $user->surname.'" phone="'.
                                            $user->phone.'" mobile="'.
                                            $user->mobile.'" email="'.
                                            $user->email.'">Editer</button>'.
                                        $delButton.
                                    '</div>'.
                                '</form>'.
                            '</div>'.
                        '</div>';
                }
                return Response($output);
            }

        }
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
