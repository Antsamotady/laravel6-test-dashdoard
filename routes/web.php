<?php

use Illuminate\Support\Facades\DB;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search','SearchController@search');


// Must be at the end 
Route::fallback(function () {
  echo "Oh, not valid route!!!";
});
