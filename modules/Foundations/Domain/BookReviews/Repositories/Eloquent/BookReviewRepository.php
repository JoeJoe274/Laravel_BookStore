<?php

namespace BookStore\Foundations\Domain\BookReviews\Repositories\Eloquent;

use BookStore\Foundations\Domain\BookReviews\Repositories\BookReviewRepositoryInterface;
use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BookStore\Foundations\Domain\BookReviews\BookReview;

class BookReviewRepository extends BaseRepository implements BookReviewRepositoryInterface
{
    protected $bookreview;

    public function __construct(bookreview $model)
    {
        parent::__construct($model);
    }

    public function getBookReviews(array $params)
    {
        return $this->Connection($params)
        ->orderBy('book_reviews.created_at', 'desc')
        ->whereNull('book_reviews.deleted_at')
        ->get();
    }

    public function getBookReviewById($id)
    {
        return $this->connection()
        ->find($id);
    }

    public function getBookById($id)
    {
        return $this->connection()
        ->find($id);
    }
}
