<?php

namespace GerenciadorProjetos\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date',
    ];

    public function client()
    {
        return $this->belongsTo(\GerenciadorProjetos\Entities\Client::class);
    }

    public function owner()
    {
        return $this->belongsTo(\GerenciadorProjetos\Entities\User::class);
    }
}
