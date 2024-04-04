<?php

namespace BookStore\Foundations\Domain\OrderDetails\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\OrderDetails\Repositories\Eloquent\OrderDetailRepository;
use BookStore\Foundations\Domain\OrderDetails\Repositories\OrderDetailRepositoryInterface;

class BindOrderDetailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderDetailRepository::class,
            OrderDetailRepositoryInterface::class
        );
    }
}
