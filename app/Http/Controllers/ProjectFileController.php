<?php

namespace GerenciadorProjetos\Http\Controllers;

use GerenciadorProjetos\Http\Requests;
use GerenciadorProjetos\Services\ProjectServices;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    /**
     * @var Projectservice
     */
    private $service;

    public function __construct(ProjectServices $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @param  Request $request
     * @return Response
     */
    public function store($id, Request $request)
    {
        if ($this->checkPermissions($id) == true) {
            $data = $request->all();
            $data['file'] = $request->file('file');
            $data['project_id'] = $id;
            return $this->service->createFile($data);
        }

        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $fileId
     * @return Response
     */
    public function destroy($id, $fileId)
    {
        if ($this->checkPermissions($id) == true) {
            return $this->service->deleteFile($fileId);
        }
        return response()->json(['error' => true, 'message' => "Acesso negado!"]);
    }

    /**
     * @param $projectId
     * @return bool|\Illuminate\Http\JsonResponse
     */
    private function isMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->service->isMember($projectId, $userId);
    }

    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->service->isOwner($projectId, $userId);
    }

    public function checkPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) || $this->isMember($projectId)) {
            return true;
        }

        return false;
    }
}
