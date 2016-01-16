<?php

namespace GerenciadorProjetos\Http\Middleware;

use Closure;
use GerenciadorProjetos\Services\ProjectServices;

class CheckProjectOwner
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
        if($this->services->isOwner($projectId) == false){
            return response()->json([
                "error" => true,
                "message" => 'Acesso negado!.'
            ]);
        }
        return $next($request);
    }
}
