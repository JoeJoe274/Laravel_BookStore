<?php

namespace BookStore\Foundations\Domain\Users\Repositories\Eloquent;

use BookStore\Foundations\Domain\Users\Repositories\UserRepositoryInterface;
use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BookStore\Foundations\Domain\Users\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function SignIn(array $params)
    {
        if (Auth::attempt(['email' => $params['email'], 'password' => $params['password']])) {
            $authUser = Auth::user();
            $token = $authUser->createToken('MyAuthApp')->plainTextToken;

            return $token;
        } else {
            return 'Unauthorised';
        }
    }

    public function getUsers(array $params)
    {
        return $this->connection()
        ->orderBy('users.created_at', 'desc')
        ->get();
    }

    public function getTotal(array $params)
    {
        return $this->connection()
        ->count('users.id');
    }

    public function getUserById($id)
    {
        return $this->connection()
        ->find($id);
    }
}
