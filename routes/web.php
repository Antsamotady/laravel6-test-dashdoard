<?php

Route::get('/', 'TaskController@index')->name('tasks.index');

Route::resource('tasks', 'TaskController')->except(['show']);
Route::put('/tasks/ajax/{task}', 'TaskController@updateAjax');
Route::put('/projects/tasks/ajax/{projectId}/{idSequence}', 'TaskController@updateProjectAjax');
Route::post('/tasks/toggle/{id}', 'TaskController@toggle')->name('task.toggle');
Route::post('/tasks/showComplete', 'TaskController@showComplete')->name('task.showComplete');

Route::resource('projects', 'ProjectController')->except(['show']);
