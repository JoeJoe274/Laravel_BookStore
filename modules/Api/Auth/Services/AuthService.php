<?php

namespace Bookstore\Api\Auth\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Api\Auth\Resources\UserResource;
use BookStore\Foundations\Domain\Users\Repositories\Eloquent\UserRepository;
use BookStore\Foundations\Domain\Users\User;

class AuthService extends BaseController {
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers (array $params)
    {
        // return 'service';
        $users = $this->userRepository->getUsers($params);

        if($users->isNotEmpty()) {

            $users = UserResource::collection($users);
            $total = $this->userRepository->getTotal($params);
            return $this->sendResponse($users, 'Retrieved Users Successfully!', $total);
        }
        else {

            $users = [];
            return $this->sendResponse($users, 'There is NO DATA to Retrieve!');
        }
    }

    public function getUserById($id)
    {
        // return 'service';
        $user = $this->userRepository->getUserById($id);

        if(empty($user)) {
            return $this->sendResponse($user, 'There is NO USER to Retrieve!');
        }
        else {
            $user = new UserResource($user);
            return $this->sendResponse($user, 'User is Retrieved by ID Successfully!');
        }
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
