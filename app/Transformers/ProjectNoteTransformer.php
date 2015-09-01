<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNote $project)
    {
        return [
            'project_id' => $project->project_id,
            'title' => $project->title,
            'note' => $project->note,
        ];
    }
}