<?php

namespace BookStore\Foundations\Domain\Users\Repositories;

interface UserRepositoryInterface
{
    public function SignIn(array $params);
}
