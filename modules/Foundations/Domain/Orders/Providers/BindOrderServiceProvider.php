<?php

namespace BookStore\Foundations\Domain\Orders\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\Orders\Repositories\Eloquent\OrderRepository;
use BookStore\Foundations\Domain\Orders\Repositories\OrderRepositoryInterface;

class BindOrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
    }
}
