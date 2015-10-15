<?php

namespace GerenciadorProjetos\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \GerenciadorProjetos\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        /*
         * OAuth2
         */
        \LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \GerenciadorProjetos\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \GerenciadorProjetos\Http\Middleware\RedirectIfAuthenticated::class,
        'csrf' => \GerenciadorProjetos\Http\Middleware\VerifyCsrfToken::class,
        'oauth' => \LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware::class,
        'oauth-user' => \LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware::class,
        'oauth-client' => \LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware::class,
        'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,
        'check.project.owner' => \GerenciadorProjetos\Http\Middleware\CheckProjectOwner::class,
        'check.project.permission' => \GerenciadorProjetos\Http\Middleware\CheckProjectPermission::class
    ];
}
