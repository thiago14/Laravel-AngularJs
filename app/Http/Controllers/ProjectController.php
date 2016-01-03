<?php

namespace GerenciadorProjetos\Http\Controllers;

use GerenciadorProjetos\Http\Requests;
use GerenciadorProjetos\Services\ProjectServices;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectServices $service)
    {
        $this->service = $service;
        $this->middleware('check.project.owner', ['except' => ['index', 'store', 'update', 'show']]);
        $this->middleware('check.project.permission', ['except' => ['index', 'store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->service->all(\Authorizer::getResourceOwnerId(), $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    /**
     * Add members in project. Request = array/int member_ids
     * @param Request $request Array/int
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember(Request $request, $id)
    {
        return $this->service->addMember($request->all(), $id);
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
}