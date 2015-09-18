<?php

namespace GerenciadorProjetos\Services;


use GerenciadorProjetos\Repositories\ClientRepository;
use GerenciadorProjetos\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientServices
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    private $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
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
        try{
            return response()->json($this->repository->skipPresenter()->find($id));
        } catch(\Exception $e) {
            return ["error" => true, "message" => utf8_encode("Cliente ID: {$id} não encontrado!")];
        }
    }

    public function all()
    {
        try{
            return response()->json($this->repository->skipPresenter()->all());
        } catch(\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Erro ao Carregar Clientes.")
            ],412);
        }
    }

    public function delete($id)
    {
        try{
            return response()->json($this->repository->delete($id));
        } catch(\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Não foi possível deletar o ID: {$id}")
            ], 412);
        }
    }

}