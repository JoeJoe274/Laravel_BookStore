<?php

namespace BookStore\Api\Auth\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Foundations\Domain\Users\User;
use DB;
use BookStore\Api\Auth\Validation\AuthValidator;
use BookStore\Api\Auth\Services\AuthService;

class UserController extends BaseController
{
    const ATTRIBUTES = [
        'name',
        'email',
        'password'
    ];

    public function __construct(
        AuthValidator $Validator,
        Authservice $service
    ) {
        $this->validator = $Validator;
        $this->service = $service;
    }

    public function index(Request $request) {
        $inputsSpecification = $request->only(
            'name',
            'email',
            'password'
        );

        $results = $this->service->getUsers($inputsSpecification);
        return $results;
    }

    public function show($id) {

        $result = $this->service->getUserById($id);
        return $result;
    }

    public function store(Request $request) {

        $inputs = array_filter($request->only(self::ATTRIBUTES), function ($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->store($inputs);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors(), 400);
        }

        $result = $this->service->createUser($inputs);

        return $result;
    }

    public function SignIn(Request $request) {

        $inputs = array_filter($request->only(self::ATTRIBUTES), function ($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->SignIn($inputs);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors(), 400);
        }

        $result = $this->service->SignIn($inputs);

        return $result;
    }
}
