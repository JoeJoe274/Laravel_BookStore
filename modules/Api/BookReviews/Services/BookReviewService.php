<?php

namespace BookStore\Api\BookReviews\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Foundations\Domain\BookReviews\Repositories\Eloquent\BookReviewRepository;
use BookStore\Api\BookReviews\Resources\BookReviewResource;
use BookStore\Foundations\Domain\BookReviews\BookReview;
use Exception;

class BookReviewService extends BaseController
{
    protected $bookReviewRepository;

    public function __construct(
        BookReviewRepository $bookReviewRepository
    ) {
        $this->bookReviewRepository = $bookReviewRepository;
    }

    public function getBookReviews(array $params)
    {

        $bookreviews = $this->bookReviewRepository->getBookReviews($params);

        if($bookreviews->isNotEmpty()) {

            $bookreviews = BookReviewResource::collection($bookreviews);

            return $this->sendResponse($bookreviews, 'Retrieve Book Reviews Successfully!');
        }
        else {
            return $this->sendResponse($bookreviews, 'There is NO Data!');
        }
    }

    public function getBookReviewById($id)
    {
        $bookreview = $this->bookReviewRepository->getBookReviewById($id);

        if(!empty($bookreview)) {
            $bookreview = new BookReviewResource($bookreview);

            return $this->sendResponse($bookreview, 'Bookreview retrieved by ID Successfully!');
        }
        else {
            return $this->sendResponse($bookreview, 'There is no record to retrieve!');
        }
    }

    public function createBookReview(array $params)
    {
        // return 'service';
        $bookreview = $this->bookReviewRepository->insertGetId($params);
        return $this->sendResponse($bookreview, 'Bookreview is created Successfully!', 0, 201);
    }

    public function deleteBookReview($id)
    {
        $bookreview = $this->bookReviewRepository->getBookReviewById($id);

        if(!empty($bookreview)) {
            $bookreview = $this->bookReviewRepository->delete($id);

            return $this->sendResponse($bookreview, 'Bookreview is deleted Successfully!', 200);
        }
        else {
            return $this->sendResponse($bookreview, "There is NO Data!", 201);
        }
    }
}
