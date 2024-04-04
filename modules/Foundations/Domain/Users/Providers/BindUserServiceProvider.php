<?php

namespace BookStore\Foundations\Domain\Users\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\Users\Repositories\UserRepositoryInterface;
use BookStore\Foundations\Domain\Users\Repositories\Eloquent\UserRepository;

class BindUserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}
