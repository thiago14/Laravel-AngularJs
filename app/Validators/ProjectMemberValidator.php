<?php

namespace GerenciadorProjetos\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'user_id' => 'required',
    ];
}