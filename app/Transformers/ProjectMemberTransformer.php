<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(ProjectMember $project)
    {
        return [
            'project_id' => $project->project_id,
            'user_id' => $project->user_id,
        ];
    }
}