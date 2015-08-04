<?php

Route::get('/', 'ClientController@index');
Route::get('/client', 'ClientController@index');
Route::post('/client','ClientController@store');
Route::get('/client/{id}','ClientController@show');
Route::put('/client/{id}','ClientController@update');
Route::delete('/client/{id}','ClientController@destroy');