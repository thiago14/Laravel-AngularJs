<?php

namespace GerenciadorProjetos\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectMember extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'user_id'
    ];

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
