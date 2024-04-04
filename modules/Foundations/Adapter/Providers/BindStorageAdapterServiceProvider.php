<?php

namespace BookStore\Foundations\Adapter\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Adapter\Storage\ImageAdapter;
use BookStore\Foundations\Adapter\Storage\ImageAdapterInterface;
use BookStore\Foundations\Adapter\Storage\StorageAdapter;
use BookStore\Foundations\Adapter\Storage\StorageAdapterInterface;

/**
 * A service provider class used to bind interfaces to the implementation of the S3 adapter.
 * 
 * @author Yarzartun
 * @copyright (c) 2024 - Zote Innovation, All Right Reserved.
 */
class BindStorageAdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ImageAdapterInterface::class,
            ImageAdapter::class
        );

        $this->app->bind(
            StorageAdapterInterface::class,
            StorageAdapter::class
        );
    }
}
