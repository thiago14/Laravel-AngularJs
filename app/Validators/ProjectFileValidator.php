<?php

namespace GerenciadorProjetos\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id' => 'required|integer',
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|max:10000'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'project_id' => 'required|integer',
            'name' => 'required',
            'description' => 'required',
        ]
    ];
}