<?php

Route::get('/', 'ClientController@index');

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {

    /* Clientes */
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit', 'update']]);

    /* Projetos */
    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit', 'update']]);

        /* Tarefas dos Projetos */
        Route::resource('project.task', 'ProjectTaskController', ['except' => ['create', 'edit', 'update']]);

        /* Anotações dos Projetos */
        Route::resource('project.note', 'ProjectNoteController', ['except' => ['create', 'edit', 'update']]);

        /* Membros do Projeto */
        Route::group(['prefix'=>'project'], function(){
            Route::post('{id}/addMember', 'ProjectController@addMember');
            Route::post('{id}/removeMember', 'ProjectController@removeMember');
            Route::get('{id}/members', 'ProjectController@members');
        });
});
