<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(ProjectMember $member)
    {
        return [
            'id' => $member->id,
            'project_id' => $member->project_id,
            'name' => $member->user->name,
            'email' => $member->user->email,
        ];
    }
}