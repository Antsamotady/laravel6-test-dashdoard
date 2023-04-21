<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('welcome');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('/dashboard/list', 'UserController@list')->name('dashboard.list');
Route::get('/dashboard/search', 'UserController@search')->name('dashboard.search');
Route::post('/dashboard/toggle/{id}', 'UserController@toggle')->name('user.toggle');
Route::get('/dashboard/menu2', 'DashboardController@menu2')->name('dashboard.menu2');
Route::get('/dashboard/menu3', 'DashboardController@menu3')->name('dashboard.menu3');
Route::get('/dashboard/menu2/submenu1', 'DashboardController@menu2Submenu1')->name('dashboard.menu2Submenu1');
Route::get('/dashboard/menu2/submenu2', 'DashboardController@menu2Submenu2')->name('dashboard.menu2Submenu2');

