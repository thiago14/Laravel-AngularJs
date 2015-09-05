<?php

Route::get('/', function(){
    return view('app');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {

    /* Clientes */
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    /* Projetos */
    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

        /* Tarefas dos Projetos */
        Route::resource('project.task', 'ProjectTaskController', ['except' => ['create', 'edit']]);

        /* Anotações dos Projetos */
        Route::resource('project.note', 'ProjectNoteController', ['except' => ['create', 'edit']]);

        /* Arquivos */
        Route::resource('project.file', 'ProjectFileController', ['except' => ['create', 'edit','show']]);

        /* Grupo Projeto */
        Route::group(['prefix'=>'project'], function(){

            /* Membros */
            Route::post('{id}/addMember', 'ProjectController@addMember');
            Route::post('{id}/removeMember', 'ProjectController@removeMember');
            Route::get('{id}/members', 'ProjectController@members');

//            /* Arquivos */
//            Route::resource('project.file', 'ProjectFileController', ['except' => ['create', 'edit','show']]);
//            Route::post('{id}/file', 'ProjectFileController@store');
//            Route::put('{id}/file/{fileId}', 'ProjectFileController@update');
//            Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');
        });
});
