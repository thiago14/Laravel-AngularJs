<?php

namespace GerenciadorProjetos\Providers;

use GerenciadorProjetos\Repositories\ClientRepository;
use GerenciadorProjetos\Repositories\ClientRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectNoteRepository;
use GerenciadorProjetos\Repositories\ProjectNoteRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectRepository;
use GerenciadorProjetos\Repositories\ProjectRepositoryEloquent;
use GerenciadorProjetos\Repositories\ProjectTaskRepository;
use GerenciadorProjetos\Repositories\ProjectTaskRepositoryEloquent;
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
    }
}
