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
 * Projetos
 */
Route::get('/project', 'ProjectController@index');
Route::post('/project','ProjectController@store');
Route::get('/project/{id}','ProjectController@show');
Route::put('/project/{id}','ProjectController@update');
Route::delete('/project/{id}','ProjectController@destroy');