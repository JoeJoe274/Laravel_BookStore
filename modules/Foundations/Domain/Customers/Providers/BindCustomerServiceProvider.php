<?php

namespace BookStore\Foundations\Domain\Customers\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\Customers\Repositories\CustomerRepositoryInterface;
use BookStore\Foundations\Domain\Customers\Repositories\Eloquent\CustomerRepository;

class BindCustomerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );
    }
}
