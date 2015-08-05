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
            return $this->repository->find($id);
        }catch (ValidatorException $e){

        }
    }

    public function all()
    {
        return $this->repository->all();
    }

}