<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ProjectMemberRepository;
use GerenciadorProjetos\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberServices
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;
    /**
     * @var ProjectMemberValidator
     */
    private $validator;

    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
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

    public function show($id, $taskId)
    {
        try {
            return response()->json($this->repository->find($taskId));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Membro ID: {$id} não encontrada!")
            ], 412);
        }
    }

    public function all($id)
    {
        try {
            return response()->json($this->repository->findWhere(['project_id'=>$id]));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Erro ao Carregar o Membro.")
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
                "message" => utf8_encode("Não foi possível deletar o ID: {$id}")
            ], 412);
        }
    }

}