<?php

Route::get('/', 'TaskController@index')->name('tasks.index');
Route::post('/tasks', 'TaskController@store')->name('tasks.store');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create');
Route::get('/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');
Route::put('/tasks/{task}', 'TaskController@update')->name('tasks.update');
Route::put('/tasks/ajax/{task}', 'TaskController@updateAjax')->name('tasks.ajax.update');
Route::delete('/tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');
