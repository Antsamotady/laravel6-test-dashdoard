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
                    ->where('status','LIKE','%'.$request->status.'%')
                    ->get();
            if($request->name && (is_null($request->status) || $request->status=='Tous'))
                $users=DB::table('users')
                    ->where('name','LIKE','%'.$request->name.'%')
                    ->get();
            if(is_null($request->name) && $request->status && $request->status!='Tous')
                $users=DB::table('users')
                    ->where('status','LIKE','%'.$request->status.'%')
                    ->get();
            if(is_null($request->name) && (is_null($request->status) || $request->status=='Tous'))
                $users=DB::table('users')
                    ->get();

            // var_dump($users->count());
            if($users){
                foreach ($users as $key => $user) {
                    $createDate = str_replace('-', '/', substr($user->created_at, 0, -9));
                    if($user->status=='Actif')
                        $status = '<input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-warning"><span class="text-success ml-2">ACTIF</span>';
                    else
                        $status = '<input type="checkbox" data-toggle="toggle" data-onstyle="outline-warning" data-offstyle="outline-success"><span class="text-warning ml-2">INACTIF</span>';

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
                                    '<div class="col-1"><img id="avatar-image-list" src="images/'.$avatar.'" alt="Avatar"></div>'.
                                    '<div class="col-2">'.$user->name.' '.$user->surname.'</div>'.
                                    '<div class="col-4">'.
                                        '<div class="col-12">'.
                                        '<button class="btn btn-info toggle-status"'.
                                            'id="toggle-status-btn-'.$user->id.'-'.$user->status.'" '.
                                            'data-action="/home/toggle/'.$user->id.'">'.
                                            'Toggle Status'.
                                        '</button>
                                        '.$status.'</div>'.
                                        '<div class="col-12">Date de création du compte : '.$createDate.'</div>'.
                                    '</div>'.
                                    '<div class="col-3">'.
                                        '<div class="col-12 text-primary d-flex align-items-center mb-2"><span class="material-icons md-18">mail</span>&nbsp;'.$user->email.'</div>'.
                                        '<div class="col-12 d-flex align-items-center mb-2"><span class="material-icons md-18">phone</span>&nbsp;'.$user->phone.'</div>'.
                                        '<div class="col-12 d-flex align-items-center mb-2"><span class="material-icons md-18">smartphone</span>&nbsp;'.$user->mobile.'</div>'.
                                    '</div>'.
                                    '<div class="col-2">'.
                                        '<button data-toggle="modal" data-backdrop="static" data-target="#modalEditUser" type="submit" class="btn btn-primary mb-4 col-12 editUser" id="'.
                                            $user->id.'" nom="'.
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
