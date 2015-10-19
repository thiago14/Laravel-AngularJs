<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ProjectMemberRepository;

class ProjectMemberServices
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    public function __construct(ProjectMemberRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($id)
    {
        try {
            return response()->json($this->repository->findWhere(['project_id'=>$id]));
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Não foi possível carregar os membros",
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
                "message" => "Membro ID: {$id} não encontrado!"
            ], 412);
        }
    }

    public function addMember($member_ids, $id)
    {
        try {
            if (is_array($member_ids['member_ids'])) {
                foreach ($member_ids['member_ids'] as $member) {
                    $this->repository->create(['project_id' => $id, 'user_id' => $member]);
                }
                return response()->json(["message" => 'Membros adicionados com sucesso.']);
            } else {
                $this->repository->create(['project_id' => $id, 'user_id' => $member_ids['member_ids']]);
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
                    $this->repository->delete($member);
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
                $this->repository->delete($member_ids['member_ids']);
                return response()->json(["message" => 'Membro removido com sucesso.']);
            } catch (\Exception $e) {
                return response()->json([
                    "error" => true,
                    "message" => 'Não foi possível remover este membro. Single',
                    'message_sistem' => $e->getMessage() . $member_ids,
                ], 412);
            }
        }
    }

}