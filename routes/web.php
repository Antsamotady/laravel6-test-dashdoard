<?php

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
  $visited = DB::select('select * from places where visited = ?', [1]); 
  $togo = DB::select('select * from places where visited = ?', [0]);

  return view('travel_list', ['visited' => $visited, 'togo' => $togo ] );
});

Route::get('/welcome', function() {
  return view('welcome');
});

Route::get('/user/{name?}',function($name = 'Virat Gandhi'){
  echo "Name: ".$name;
  });


  // Must be at the end 
Route::fallback(function () {
    echo "Oh, not valid route!";
  });