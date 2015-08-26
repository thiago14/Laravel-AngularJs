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
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        return $this->service->all($id);
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
    public function show($id, $memberId)
    {
        return $this->service->show($id, $memberId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id, $memberId)
    {
        return$this->service->update($request->all(), $memberId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $memberId)
    {
        return $this->service->delete($memberId);
    }
}
