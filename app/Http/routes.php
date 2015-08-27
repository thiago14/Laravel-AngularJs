<?php

Route::get('/', 'ClientController@index');

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

/*
 * Clientes
 */
Route::get('/client', 'ClientController@index');
Route::post('/client','ClientController@store');
Route::get('/client/{id}','ClientController@show');
Route::put('/client/{id}','ClientController@update');
Route::delete('/client/{id}','ClientController@destroy');

Route::post('/project/{id}/addMember','ProjectController@addMember');
Route::post('/project/{id}/removeMember','ProjectController@removeMember');
Route::get('/project/{id}/members','ProjectController@member');

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
 * Membros do Projeto
 */
Route::get('/project/{id}/member', 'ProjectMemberController@index');
Route::post('/project/{id}/member','ProjectMemberController@store');
Route::get('/project/{id}/member/{memberId}','ProjectMemberController@show');
Route::put('/project/{id}/member/{memberId}','ProjectMemberController@update');
Route::delete('/project/{id}/member/{memberId}','ProjectMemberController@destroy');
/*
 * Projetos
 */
Route::get('/project', 'ProjectController@index');
Route::post('/project','ProjectController@store');
Route::get('/project/{id}','ProjectController@show');
Route::put('/project/{id}','ProjectController@update');
Route::delete('/project/{id}','ProjectController@destroy');