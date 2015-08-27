<?php

namespace GerenciadorProjetos\Entities;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_clients';

    protected $fillable = [
        'id',
        'secret',
        'name'
    ];

}