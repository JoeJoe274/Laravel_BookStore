<?php

namespace Bookstore\Api\Auth\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Foundations\Domain\Users\Repositories\Eloquent\UserRepository;

class AuthService extends BaseController {
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function createUser (array $params)
    {
        $id = $this->userRepository->insertGetId($params);

        return $this->sendResponse($id, 'Register User Successfully!', 201);
    }

    public function SignIn (array $params)
    {
        $token = $this->userRepository->SignIn($params);

        if ($token === 'Unauthorised') {
            return $this->sendError('Unauthorised', 'Unauthorised Authebtication!', 401);
        }

        return $this->sendResponse ($token, 'Sign In Successfully!');
    }
}
