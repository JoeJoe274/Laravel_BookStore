<?php

namespace BookStore\Foundations\Domain\BookReviews\Providers;

use Illuminate\Support\ServiceProvider;
use BookStore\Foundations\Domain\BookReviews\Repositories\BookReviewRepositoryInterface;
use BookStore\Foundations\Domain\BookReviews\Repositories\Eloquent\BookReviewRepository;

class BindBookReviewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            BookReviewRepositoryInterface::class,
            BookReviewRepository::class
        );
    }
}
