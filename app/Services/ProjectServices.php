<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ProjectMemberRepository;
use GerenciadorProjetos\Repositories\ProjectRepository;
use GerenciadorProjetos\Validators\ProjectValidator;
use Illuminate\Contracts\Validation\ValidationException;
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
    /**
     * @var ProjectMemberRepository
     */
    private $repository_members;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $repository_members)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->repository_members = $repository_members;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidationException $e) {
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
            return response()->json($this->repository->with(['client', 'owner', 'members', 'notes', 'tasks'])->find($id));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Projeto ID: {$id} não encontrado!"
            ], 412);
        }
    }

    public function all($userId)
    {
        try {
            return response()->json($this->repository->with(['client', 'owner', 'members', 'tasks', 'notes'])->findWhere(['owner_id'=> $userId]));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Erro ao Carregar Projetos.",
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

    public function members($id)
    {
        try {
            $project = $this->repository->skipPresenter()->find($id);
            $this->repository->skipPresenter(false);
            return response()->json($project->members);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Não foi possível carregar os membros"
            ], 412);
        }
    }

    public function addMember($member_ids, $id)
    {
        try {
            if (is_array($member_ids['member_ids'])) {
                foreach ($member_ids['member_ids'] as $member) {
                    $this->repository_members->create(['project_id' => $id, 'user_id' => $member]);
                }
                return response()->json(["message" => 'Membros adicionados com sucesso.']);
            } else {
                $this->repository_members->create(['project_id' => $id, 'user_id' => $member_ids['member_ids']]);
                return response()->json(["message" => 'Membro adicionado com sucesso.']);
            }
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => 'Não foi possível adicioner este membro.'
            ], 412);
        }
    }

    public function removeMember($member_ids, $id)
    {
        if (is_array($member_ids['member_ids'])) {
            try {
                foreach ($member_ids['member_ids'] as $member) {
                    $this->repository_members->delete($this->repository_members->findWhere(['project_id' => $id, 'user_id' => $member], ['id'])->first()->id);
                }
                return response()->json(["message" => 'Membros removidos com sucesso.']);
            } catch (\Exception $e) {
                return response()->json([
                    "error" => true,
                    "message" => 'Não foi possível remover este membro.'
                ], 412);
            }
        } else {
            try {
                $this->repository_members->delete($this->repository_members->findWhere(['project_id' => $id, 'user_id' => $member_ids['member_ids']], ['id'])->first()->id);
                return response()->json(["message" => 'Membro removido com sucesso.']);
            } catch (\Exception $e) {
                return response()->json([
                    "error" => true,
                    "message" => 'Não foi possível remover este membro.'
                ], 412);
            }
        }
    }

    public function isMember($projectId)
    {
        try{
            $userId = \Authorizer::getResourceOwnerId();
            if($this->repository->isMember($projectId, $userId) == false){
                return false;
            }

            return true;

        }catch (\Exception $e){
            return response()->json([
                "error" => true,
                "message" => "Não foi possível validar o ID: {$userId}"
            ], 412);
        }
    }

    public function isOwner($projectId)
    {
        try{
            $userId = \Authorizer::getResourceOwnerId();
            if(count($this->repository->isOwner($projectId, $userId))){
                return true;
            }

            return false;

        }catch (\Exception $e){
            return response()->json([
                "error" => true,
                "message" => "Não foi possível validar o ID: {$userId}"
            ], 412);
        }
    }

    public function checkPermissions($projectId)
    {
        if($this->isOwner($projectId) || $this->isMember($projectId)){
            return true;
        }

        return false;
    }

}