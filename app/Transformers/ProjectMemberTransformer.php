<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'user_id' => $user->id,
            'name' => $user->name,
        ];
    }
}