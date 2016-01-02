<?php

namespace GerenciadorProjetos\Transformers;

use GerenciadorProjetos\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['owner', 'client', 'members', 'tasks', 'notes', 'files'];

    public function transform(Project $project)
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'description' => $project->description,
            'owner_id' => $project->owner_id,
            'client_id' => $project->client_id,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
            'owner' => ($project->owner_id == \Authorizer::getResourceOwnerId())? true : false,
            'tasks_count' => $project->tasks->count(),
            'tasks_opened' => $this->openedTasks($project)
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new UserTransformer());
    }

    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }

    public function includeNotes(Project $project)
    {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }

    public function includeFiles(Project $project)
    {
        return $this->collection($project->files, new ProjectFileTransformer());
    }

    public function includeOwner(Project $project)
    {
        return $this->item($project->owner, new UserTransformer());
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }

    protected function openedTasks(Project $project)
    {
        $count = 0;
        foreach($project->tasks as $task){
            if($task->status == 1){
                $count++;
            }
        }
        return $count;
    }
}