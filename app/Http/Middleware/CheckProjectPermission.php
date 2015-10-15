<?php

namespace GerenciadorProjetos\Http\Middleware;

use Closure;
use GerenciadorProjetos\Services\ProjectServices;

class CheckProjectPermission
{
    /**
     * @var ProjectServices
     */
    private $services;

    public function __construct(ProjectServices $services)
    {
        $this->services = $services;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projectId = $request->route('project');
        if($this->services->checkPermissions($projectId) == false){
            return ['error' => 'Você não tem acessar este projeto!'];
        }
        return $next($request);
    }
}
