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
  })->name('anarana');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Formulaire de contact
Route::get('/contact', 'ContactsController@create')->name('contact.create');
Route::post('/contact', 'ContactsController@store')->name('contact.store');


// Must be at the end 
Route::fallback(function () {
  echo "Oh, not valid route!";
});
