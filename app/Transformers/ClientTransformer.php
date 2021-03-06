<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['projects'];

    public function transform(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs,
        ];
    }

    public function includeProjects(Client $client)
    {
        $projectsTransformer = new ProjectTransformer();
        $projectsTransformer->setDefaultIncludes([]);
        return $this->collection($client->project, $projectsTransformer);
    }
}