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
        foreach($project->members as $member){
            if($member->id == $userId){
                return true;
            }
        }
        return false;
    }

    public function isOwner($projectId, $userId)
    {

        $result = $this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId])->first();
        $this->skipPresenter(FALSE);

        return $result;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}