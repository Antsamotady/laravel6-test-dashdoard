<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function index() {
        return view('search.search');
    }



    public function search(Request $request)
    {
        if($request->ajax()) {
            $output="";

            if($request->name && $request->status && $request->status!='Tous')
                $users=DB::table('users')
                    ->where('name','LIKE','%'.$request->name.'%')
                    ->where('status','LIKE','%'.$request->status.'%')
                    ->get();
            elseif($request->name && (is_null($request->status) || $request->status=='Tous'))
                $users=DB::table('users')
                    ->where('name','LIKE','%'.$request->name.'%')
                    ->get();
            elseif(is_null($request->name) && !is_null($request->status) && $request->status!='Tous')
                $users=DB::table('users')
                    ->where('status','LIKE','%'.$request->status.'%')
                    ->get();
            else
                $users=DB::table('users')
                    ->get();

            if($users){
                foreach ($users as $key => $user) {
                    $createDate = str_replace('-', '/', substr($user->created_at, 0, -9));
                    if($user->status=='Actif')
                        $status = '<input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-warning"><span class="text-success ml-2">ACTIF</span>';
                    else
                        $status = '<input type="checkbox" data-toggle="toggle" data-onstyle="outline-warning" data-offstyle="outline-success"><span class="text-warning ml-2">INACTIF</span>';

                    if(!$user->superuser)
                        $delButton = '<button type="submit" class="btn btn-warning col-12" id="delUser">Supprimer</button>';
                    else
                        $delButton = '';

                    $output.='<div class="card mt-2">'.
                            '<div class="card-body">'.
                                '<form class="row row-cols-lg-auto g-3">'.
                                    '<div class="col-1">'.'IMAGE'.'</div>'.
                                    '<div class="col-2">'.$user->name.' '.$user->surname.'</div>'.
                                    '<div class="col-4">'.
                                        '<div class="col-12">'.$status.'</div>'.
                                        '<div class="col-12">Date de création du compte : '.$createDate.'</div>'.
                                    '</div>'.
                                    '<div class="col-3">'.
                                        '<div class="col-12 text-primary"><span class="material-icons md-18">mail</span>'.$user->email.'</div>'.
                                        '<div class="col-12"><span class="material-icons md-18">phone</span>'.$user->phone.'</div>'.
                                        '<div class="col-12"><span class="material-icons md-18">smartphone</span>'.$user->mobile.'</div>'.
                                    '</div>'.
                                    '<div class="col-2">'.
                                        '<button type="submit" class="btn btn-primary mb-4 col-12" id="editUser">Editer</button>'.
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