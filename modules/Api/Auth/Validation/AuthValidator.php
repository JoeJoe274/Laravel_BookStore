<?php

namespace BookStore\Api\Auth\Validation;

use Illuminate\Support\Facades\Validator;

class AuthValidator
{
    public function store(array $inputs)
    {
        return Validator::make($inputs, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

    public function SignIn(array $inputs)
    {
        return Validator::make($inputs, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

}
