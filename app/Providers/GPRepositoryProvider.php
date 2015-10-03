<?php

namespace GerenciadorProjetos\Providers;

use GerenciadorProjetos\Repositories\ClientRepository;
use GerenciadorProjetos\Repositories\ClientRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectFileRepository;
use GerenciadorProjetos\Repositories\ProjectFileRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectMemberRepository;
use GerenciadorProjetos\Repositories\ProjectMemberRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectNoteRepository;
use GerenciadorProjetos\Repositories\ProjectNoteRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectRepository;
use GerenciadorProjetos\Repositories\ProjectRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectTaskRepository;
use GerenciadorProjetos\Repositories\ProjectTaskRepositoryEloquent;
use GerenciadorProjetos\Repositories\UserRepository;
use GerenciadorProjetos\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class GPRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryEloquent::class
        );

        $this->app->bind(
            ProjectRepository::class,
            ProjectRepositoryEloquent::class
        );

        $this->app->bind(
            ProjectNoteRepository::class,
            ProjectNoteRepositoryEloquent::class
        );

        $this->app->bind(
            ProjectTaskRepository::class,
            ProjectTaskRepositoryEloquent::class
        );

        $this->app->bind(
            ProjectMemberRepository::class,
            ProjectMemberRepositoryEloquent::class
        );

        $this->app->bind(
            ProjectFileRepository::class,
            ProjectFileRepositoryEloquent::class
        );

        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );
    }
}
