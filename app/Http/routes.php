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
 * Anotações dos Projetos
 */
Route::get('/project/{id}/note', 'ProjectNoteController@index');
Route::post('/project','ProjectNoteController@store');
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