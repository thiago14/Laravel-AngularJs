<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ProjectNoteRepository;
use GerenciadorProjetos\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteServices
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    private $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

    public function show($id, $noteId)
    {
        try {
            return response()->json($this->repository->find($noteId));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Anotação ID: {$id} não encontrada!")
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
                "message" => utf8_encode("Erro ao Carregar Anotação.")
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