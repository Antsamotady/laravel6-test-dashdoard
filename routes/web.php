<?php

use Illuminate\Support\Facades\DB;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

// Formulaire de contact
Route::get('/contact', 'ContactsController@create')->name('contact.create');
Route::post('/contact', 'ContactsController@store')->name('contact.store');


// Must be at the end 
Route::fallback(function () {
  echo "Oh, not valid route!!!";
});
