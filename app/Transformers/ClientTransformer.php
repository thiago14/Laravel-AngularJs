<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $client)
    {
        return [
            'nome' => $client->name,
            'responsavel' => $client->responsible,
            'email' => $client->email,
            'telefone' => $client->phone,
            'endereco' => $client->address,
            'obs' => $client->obs,
        ];
    }
}