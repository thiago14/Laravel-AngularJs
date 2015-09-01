<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'nome' => $user->name,
            'email' => $user->email,
        ];
    }
}