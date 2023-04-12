<?php

use Illuminate\Support\Facades\DB;

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('/dashboard/menu1', 'DashboardController@menu1')->name('dashboard.menu1');
Route::get('/dashboard/menu2', 'DashboardController@menu2')->name('dashboard.menu2');
Route::get('/dashboard/menu3', 'DashboardController@menu3')->name('dashboard.menu3');
Route::get('/dashboard/menu2/submenu1', 'DashboardController@submenu1')->name('dashboard.submenu1');
Route::get('/dashboard/menu2/submenu2', 'DashboardController@submenu2')->name('dashboard.submenu2');


