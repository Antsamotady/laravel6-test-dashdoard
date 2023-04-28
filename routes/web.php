<?php

Route::get('/', function () {
  return view('welcome');
});

Route::get('/here', 'ApiController@getUsers');
