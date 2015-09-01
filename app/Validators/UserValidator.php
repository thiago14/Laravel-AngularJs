<?php

namespace GerenciadorProjetos\Validators;

use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email',
        'password' => 'required',
    ];
}