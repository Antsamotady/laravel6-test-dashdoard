<?php

Route::get('/', 'TaskController@index')->name('tasks.index');
Route::post('/tasks', 'TaskController@store')->name('tasks.store');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create');
Route::get('/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');
Route::put('/tasks/{task}', 'TaskController@update')->name('tasks.update');
Route::put('/tasks/ajax/{task}', 'TaskController@updateAjax')->name('tasks.ajax.update');
Route::put('/projects/tasks/ajax/{projectId}/{idSequence}', 'TaskController@updateProjectAjax')->name('tasks.ajax.update');

Route::delete('/tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');

Route::get('/projects', 'ProjectController@index')->name('projects.index');
Route::get('/projects/create', 'ProjectController@create')->name('projects.create');
Route::post('/projects', 'ProjectController@store')->name('projects.store');
Route::get('/projects/{project}/edit', 'ProjectController@edit')->name('projects.edit');
Route::put('/projects/{project}', 'ProjectController@update')->name('projects.update');
Route::delete('/projects/{project}', 'ProjectController@destroy')->name('projects.destroy');

