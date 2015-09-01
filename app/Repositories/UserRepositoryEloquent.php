<?php

namespace GerenciadorProjetos\Repositories;

use GerenciadorProjetos\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }
}