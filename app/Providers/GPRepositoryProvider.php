<?php

namespace GerenciadorProjetos\Providers;

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
            \GerenciadorProjetos\Repositories\ClientRepository::class,
            \GerenciadorProjetos\Repositories\ClientRepositoryEloquent::class
        );

        $this->app->bind(
            \GerenciadorProjetos\Repositories\ProjectRepository::class,
            \GerenciadorProjetos\Repositories\ProjectRepositoryEloquent::class
        );
    }
}
