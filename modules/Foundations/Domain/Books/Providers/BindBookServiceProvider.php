<?php

namespace BookStore\Foundations\Domain\Books\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\Books\Repositories\BookRepositoryInterface;
use BookStore\Foundations\Domain\Books\Repositories\Eloquent\BookRepository;

class BindBookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );
    }
}
