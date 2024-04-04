<?php

namespace BookStore\Foundations\Domain\BookReviews\Repositories;

interface BookReviewRepositoryInterface
{
    public function getBookReviews(array $params);

    public function getBookReviewById($id);
}
