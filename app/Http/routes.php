<?php

Route::get('/', 'ClientController@index');

/*
 * Clientes
 */
Route::get('/client', 'ClientController@index');
Route::post('/client','ClientController@store');
Route::get('/client/{id}','ClientController@show');
Route::put('/client/{id}','ClientController@update');
Route::delete('/client/{id}','ClientController@destroy');

/*
 * Tarefas dos Projetos
 */
Route::get('/project/{id}/task', 'ProjectTaskController@index');
Route::post('/project/{id}/task','ProjectTaskController@store');
Route::get('/project/{id}/task/{taskId}','ProjectTaskController@show');
Route::put('/project/{id}/task/{taskId}','ProjectTaskController@update');
Route::delete('/project/{id}/task/{taskId}','ProjectTaskController@destroy');

/*
 * Anotações dos Projetos
 */
Route::get('/project/{id}/note', 'ProjectNoteController@index');
Route::post('/project/{id}/note','ProjectNoteController@store');
Route::get('/project/{id}/note/{noteId}','ProjectNoteController@show');
Route::put('/project/{id}/note/{noteId}','ProjectNoteController@update');
Route::delete('/project/{id}/note/{noteId}','ProjectNoteController@destroy');

/*
 * Projetos
 */
Route::get('/project', 'ProjectController@index');
Route::post('/project','ProjectController@store');
Route::get('/project/{id}','ProjectController@show');
Route::put('/project/{id}','ProjectController@update');
Route::delete('/project/{id}','ProjectController@destroy');