<?php

Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {

    /* Usuário */
    Route::get('user/authenticated', ['as' => 'user.authenticated', 'uses' => 'UserController@authenticated']);
    Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);

    /* Clientes */
    Route::get('client/searchLetters', 'ClientController@getLetters');
    Route::post('client/byLetter', 'ClientController@postClientByLetter');
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    /* Projetos */
    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

        /* Tarefas dos Projetos */
        Route::resource('project.task', 'ProjectTaskController', ['except' => ['create', 'edit']]);

        /* Anotações dos Projetos */
        Route::resource('project.note', 'ProjectNoteController', ['except' => ['create', 'edit']]);

        /* Arquivos */
        Route::resource('project.file', 'ProjectFileController', ['except' => ['create', 'edit']]);

        /* Membros */
        Route::resource('project.member', 'ProjectMemberController', ['except' => ['create', 'edit', 'update', 'destroy']]);

        /* Grupo Projeto */
        Route::group(['middleware' => 'check.project.permission', 'prefix' => 'project'], function () {
            /* Membros */
//            Route::post('{project}/addMember', 'ProjectController@addMember');
            Route::post('{project}/member/remove', 'ProjectMemberController@destroy');
//            Route::get('{project}/members', 'ProjectController@members');

            /* Arquivos */
            Route::get('{project}/file/{idFile}/download', 'ProjectFileController@download');
    //      Route::resource('project.file', 'ProjectFileController', ['except' => ['create', 'edit','show']]);
    //      Route::post('{id}/file', 'ProjectFileController@store');
    //      Route::put('{id}/file/{fileId}', 'ProjectFileController@update');
    //      Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');
        });
});
