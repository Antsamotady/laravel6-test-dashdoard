<?php

use Illuminate\Support\Facades\DB;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@store')->name('user.store');
Route::post('/home/toggle/{id}', 'HomeController@toggle')->name('user.toggle');
Route::post('/home/update/{id}', 'HomeController@update')->name('user.update');
Route::get('/home/delete/{id}', 'HomeController@destroy')->name('user.destroy');

Route::get('/search','SearchController@search');


// Must be at the end 
Route::fallback(function () {
  echo "Oh, not valid route!!!";
});
