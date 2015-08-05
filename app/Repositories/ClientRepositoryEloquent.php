<?php

namespace GerenciadorProjetos\Repositories;

use GerenciadorProjetos\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        return Client::class;
    }

    public function create(array $data)
    {
        return Client::create($data);
    }

    public function update(array $data, $id)
    {
        return Client::find($id)->update($data);
    }

    public function show($id)
    {
        return Client::find($id);
    }

    public function delete($id)
    {
        return Client::find($id)->delete();
    }

}