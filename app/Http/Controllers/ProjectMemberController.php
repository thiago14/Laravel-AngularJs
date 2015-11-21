<?php

namespace GerenciadorProjetos\Http\Controllers;

use GerenciadorProjetos\Http\Requests;
use GerenciadorProjetos\Services\ProjectMemberServices;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberService
     */
    private $service;

    public function __construct(ProjectMemberServices $service)
    {
        $this->service = $service;
        $this->middleware('check.project.owner', ['except' => ['index']]);
        $this->middleware('check.project.permission', ['except' => ['index', 'store', 'update', 'destroy']]);
    }

    /**
     * Add members in project. Request = array/int member_ids
     * @param Request $request Array/int
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id)
    {
        return $this->service->addMember($request->all(), $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id, $idMember)
    {
        return $this->service->show($idMember);
    }

    /**
     * Remove members in project. Request = array/int member_ids
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        return $this->service->removeMember($request->all(), $id);
    }

    /**
     * Get all members in project
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        return $this->service->all($id);
    }
}