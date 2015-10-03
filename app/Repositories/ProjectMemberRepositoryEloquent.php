<?php

namespace GerenciadorProjetos\Repositories;

use GerenciadorProjetos\Entities\ProjectMember;
use GerenciadorProjetos\Presenters\ProjectMemberPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProjectMemberRepositoryEloquent
 * @package namespace GerenciadorProjetos\Repositories;
 */
class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectMember::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }

    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }
}