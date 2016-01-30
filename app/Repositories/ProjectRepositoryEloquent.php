<?php

namespace GerenciadorProjetos\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use GerenciadorProjetos\Entities\Project;
use GerenciadorProjetos\Presenters\ProjectPresenter;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace GerenciadorProjetos\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isMember($projectId, $userId)
    {
        $project = $this->skipPresenter()->find($projectId);
        $this->skipPresenter(FALSE);
        foreach ($project->members as $member) {
            if ($member->id == $userId) {
                return true;
            }
        }
        return false;
    }

    public function isOwner($projectId, $userId)
    {

        $result = $this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId])->first();

        return $result;
    }

    public function findProjects($userId, $limit = null, $columns = array('*'), $params)
    {
        if($params->get('owner')){
            return $this->scopeQuery(function ($query) use ($userId) {
                return $query->select('projects.*')
                    ->orWhere('projects.owner_id', '=', $userId)
                    ->orderby('created_at', 'desc');
            })->paginate($limit, $columns);
        }elseif($params->get('member')){
            return $this->scopeQuery(function ($query) use ($userId) {
                return $query->select('projects.*')
                    ->leftJoin('project_members', function ($join) use ($userId) {
                        $join->on('projects.id', '=', 'project_members.project_id')
                            ->where('project_members.user_id', '=', $userId);
                    })
                    ->orWhereRaw('projects.id = project_members.project_id')
                    ->orderby('created_at', 'desc');
            })->paginate($limit, $columns);
        }
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projects.*')
                ->leftJoin('project_members', function ($join) use ($userId) {
                    $join->on('projects.id', '=', 'project_members.project_id')
                        ->where('project_members.user_id', '=', $userId);
                })
                ->orWhere('projects.owner_id', '=', $userId)
                ->orWhereRaw('projects.id = project_members.project_id')
                ->orderby('created_at', 'desc');
        })->paginate($limit, $columns);
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}