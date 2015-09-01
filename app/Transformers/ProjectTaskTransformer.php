<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $project)
    {
        return [
            'project_id' => $project->project_id,
            'name' => $project->name,
            'start_date' => $project->start_date,
            'due_date' => $project->due_date,
            'status' => $project->status,
        ];
    }
}