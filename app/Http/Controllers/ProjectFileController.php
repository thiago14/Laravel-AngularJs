<?php

namespace GerenciadorProjetos\Http\Controllers;

use GerenciadorProjetos\Http\Requests;
use GerenciadorProjetos\Services\ProjectFileServices;
use GerenciadorProjetos\Services\ProjectServices;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileService
     */
    private $service;
    /**
     * @var ProjectServices
     */
    private $projectServices;

    public function __construct(ProjectFileServices $service, ProjectServices $projectServices)
    {
        $this->service = $service;
        $this->projectServices = $projectServices;
        $this->middleware('check.project.owner', ['except' => ['index']]);
        $this->middleware('check.project.permission', ['except' => ['index', 'store', 'update', 'destroy']]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        return $this->service->all($id);
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
        if ($this->projectServices->checkPermissions($id) == true) {
            $data = $request->all();
            $data['file'] = $request->file('file');
            $data['project_id'] = $id;
            return $this->service->create($data);
        }

        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * @param $id
     * @param $idFile
     * @return \Illuminate\Http\JsonResponse
     */
    public function download($id, $idFile)
    {
        if ($this->projectServices->checkPermissions($id) == true) {
            $file = $this->service->getFilePath($idFile);
            $fileContent = file_get_contents($file['filePath']);
            return [
                'file' => base64_encode($fileContent),
                'size' => filesize($file['filePath']),
                'name' => $file['fileDb']['name'],
                'extension' => $file['fileDb']['extension'],
                'id' => $file['fileDb']['id']
            ];
        }
        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * @param $id
     * @param $idFile
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $idFile)
    {
        if ($this->projectServices->checkPermissions($id) == true) {
            return $this->service->show($idFile);
        }
        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $idFile
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(Request $request, $id, $idFile)
    {
        if ($this->projectServices->checkPermissions($id) == true) {
            return $this->service->update($request->all(), $idFile);
        }
        return response()->json(["error" => true, "message" => "Acesso negado!"], 412);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $idFile
     * @return Response
     */
    public function destroy($id, $idFile)
    {
        if ($this->projectServices->checkPermissions($id) == true) {
            return $this->service->delete($idFile);
        }
        return response()->json(['error' => true, 'message' => "Acesso negado!"]);
    }

}
