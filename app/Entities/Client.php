<?php

namespace GerenciadorProjetos\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'
    ];

    public function project()
    {
        return $this->hasMany(\GerenciadorProjetos\Entities\Project::class);
    }
}