<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ProjectFileRepository;
use GerenciadorProjetos\Validators\ProjectFileValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileServices
{
    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectFileValidator
     */
    private $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;


    public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function all($projectId)
    {
        try {
            return response()->json($this->repository->findWhere(['project_id'=> $projectId]));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Erro ao Carregar Arquivo.",
            ], 412);
        }
    }

    public function show($id)
    {
        try {
            return response()->json($this->repository->find($id));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Arquivo ID: {$id} não encontrado!"
            ], 412);
        }
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $data['extension'] = $data['file']->getClientOriginalExtension();
            $projectFile = $this->repository->create($data);

            $this->storage->put($projectFile->id . '.' . $data['extension'], $this->filesystem);

            return response()->json(['message' => "Arquivo salvo com sucesso!"]);
        } catch (ValidatorException $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessageBag()
            ], 412);
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return response()->json([
                "error" => true,
                "message" => $e->getMessageBag()
            ], 412);
        }
    }

    public function delete($fileId)
    {
        try{
            $file = $this->repository->skipPresenter()->find($fileId);
            if($this->storage->exists($file->id.'.'.$file->extension)){
                $this->storage->delete($file->id.'.'.$file->extension);
            }
            $file->delete();

            return response()->json(['message'=> "Arquivo excluido com sucesso!"]);
        }catch (\Exception $e){
            return response()->json(['error' => true ,'message'=> "Erro ao tentar excluir o arquivo."], 412);
        }
    }

    public function getFilePath($id){
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseUrl($projectFile);
    }

    public function getBaseUrl($projectFile)
    {
        switch($this->storage->getDefaultDriver()){
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix() . '/' . $projectFile->id . '.' . $projectFile->extension;
        }
    }

}