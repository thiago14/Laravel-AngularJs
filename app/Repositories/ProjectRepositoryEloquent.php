<?php

namespace GerenciadorProjetos\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use GerenciadorProjetos\Entities\Project;

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
        return $this->findWhere(['id' => $projectId, 'user_id' => $userId], ['id'])->first();
    }

    public function isOwner($projectId, $userId)
    {
        return $this->findWhere(['id' => $projectId, 'owner_id' => $userId], ['id'])->first();
    }
}