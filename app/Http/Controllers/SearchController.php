<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index() {
        return view('search.search');
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

            // var_dump($users->count());
            if($users){
                foreach ($users as $key => $user) {
                    $createDate = str_replace('-', '/', substr($user->created_at, 0, -9));

                    if($user->status=='Actif') {
                        $status = '<span id="toggle-status-txt-'.$user->id.'" class="font-weight-bolder" style="color: #5cb85c;">ACTIF</span>';
                        $switchBtn = '<div class="col-6 toggle-status" id="toggle-status-btn-'.$user->id.'-'.$user->status.'" data-action="/home/toggle/'.$user->id.'"><div class="button-toggle b2" id="switch-status-btn"><input type="checkbox" class="checkbox" /><div class="knobs"><span></span></div><div class="layer"></div></div></div>';
                    } else {
                        $status = '<span id="toggle-status-txt-'.$user->id.'" class="font-weight-bolder" style="color: #fe794e;">INACTIF</span>';
                        $switchBtn = '<div class="col-6 toggle-status" id="toggle-status-btn-'.$user->id.'-'.$user->status.'" data-action="/home/toggle/'.$user->id.'"><div class="button-toggle b2" id="switch-status-btn"><input type="checkbox" class="checkbox" checked/><div class="knobs"><span></span></div><div class="layer"></div></div></div>';
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
                                    '<div class="col-2"><img class="ml-4" id="avatar-image-list" src="images/'.$avatar.'" alt="Avatar"></div>'.
                                    '<div class="col-2"><p><strong>'.$user->name.' '.$user->surname.'</strong></p></div>'.
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

}
