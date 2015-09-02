<?php

namespace GerenciadorProjetos\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required',
        'description' => 'required',
        'file' => 'required|max:10000'
    ];
}