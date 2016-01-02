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

    public function show($id)
    {
        try{
            return response()->json($this->repository->find($id));
        } catch(\Exception $e) {
            return ["error" => true, "message" => utf8_encode("Cliente ID: {$id} não encontrado!")];
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

    public function all($limit)
    {
        try{
            return response()->json($this->repository->paginate($limit));
        } catch(\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Erro ao Carregar Clientes.")
            ],412);
        }
    }

    public function getLetters()
    {
        try{
            $clients = $this->repository->scopeQuery(function($query){
                return $query->orderBy('name');
            })->all();
            foreach($clients['data'] as $key => $client){
                $letters[] = substr($client['name'],0,1);
            }
            return response()->json(['meta' => array_unique($letters)]);
        } catch(\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => utf8_encode("Erro ao Carregar Clientes.")
            ],412);
        }
    }

}