<?php

namespace BookStore\Foundations\Domain\Base\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\Base\Repositories\BaseRepositoryInterface;
use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;

class BindBaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            BaseRepositoryInterface::class,
            BaseRepository::class
        );
    }
}
