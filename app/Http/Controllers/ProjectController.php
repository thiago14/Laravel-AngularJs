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
        return $this->service->all();
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
        return $this->service->show($id);
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
        return$this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember(Request $request, $id)
    {
        return $this->service->addMember($request->all(), $id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMember(Request $request, $id)
    {
        return $this->service->removeMember($request->all(), $id);
    }

    public function isMember($projectId, $userId)
    {
        return $this->service->isMember($projectId, $userId);
    }
}
