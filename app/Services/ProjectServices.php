<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ProjectRepository;
use GerenciadorProjetos\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectServices
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorExceptionon $e) {
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

    public function show($id)
    {
        try {
            return response()->json($this->repository->find($id));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Projeto ID: {$id} não encontrado!"
            ], 412);
        }
    }

    public function all()
    {
        try {
            return response()->json($this->repository->all());
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Erro ao Carregar Projetos."
            ], 412);
        }
    }

    public function delete($id)
    {
        try {
            return response()->json($this->repository->delete($id));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Não foi possível deletar o ID: {$id}"
            ], 412);
        }
    }

}