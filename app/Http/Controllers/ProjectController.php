<?php

namespace GerenciadorProjetos\Http\Controllers;

use GerenciadorProjetos\Http\Requests;
use GerenciadorProjetos\Services\ProjectServices;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->service->all(\Authorizer::getResourceOwnerId());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if($this->checkPermissions($id) == true){
            return $this->service->show($id);
        }
        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkPermissions($id) == true){
            return $this->service->update($request->all(), $id);
        }
        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if($this->checkPermissions($id) == true){
            return $this->service->delete($id);
        }
        return response()->json(['error'=> true, 'message' => "Acesso negado!"]);
    }

    /**
     * Add members in project. Request = array/int member_ids
     * @param Request $request Array/int
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember(Request $request, $id)
    {
        if($this->checkPermissions($id) == true){
            return $this->service->addMember($request->all(), $id);
        }
        return response()->json(['error'=> true, 'message' => "Acesso negado!"]);
    }

    /**
     * Remove members in project. Request = array/int member_ids
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMember(Request $request, $id)
    {
        return $this->service->removeMember($request->all(), $id);

    }

    /**
     * Get all members in project
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function members($id)
    {
        return $this->service->members($id);
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
        if($this->checkProjectOwner($projectId) || $this->isMember($projectId)){
            return true;
        }

        return false;
    }
}
