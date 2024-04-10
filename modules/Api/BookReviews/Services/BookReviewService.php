<?php

namespace BookStore\Api\BookReviews\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Api\BookReviews\Resources\BookReviewResource;
use BookStore\Foundations\Domain\BookReviews\Repositories\Eloquent\BookReviewRepository;
use BookStore\Foundations\Domain\BookReviews\BookReview;
use Exception;
use BookStore\Foundations\Domain\Books\Repositories\Eloquent\BookRepository;

class BookReviewService extends BaseController
{
    protected $bookReviewRepository;

    protected $bookRepository;

    public function __construct(
        BookReviewRepository $bookReviewRepository,
        BookRepository $bookRepository
    ) {
        $this->bookReviewRepository = $bookReviewRepository;
        $this->bookRepository = $bookRepository;
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

    // public function getBookReviewById($id)
    // {
    //     $bookreview = $this->bookReviewRepository->getBookReviewById($id);

    //     if(!empty($bookreview)) {
    //         $bookreview = new BookReviewResource($bookreview);

    //         return $this->sendResponse($bookreview, 'Bookreview retrieved by ID Successfully!');
    //     }
    //     else {
    //         return $this->sendResponse($bookreview, 'There is no record to retrieve!');
    //     }
    // }
    public function getBookReviewById($id)
    {
        $book = $this->bookRepository->getBookById($id);

        if(empty($book)) {
            return $this->sendResponse($book, 'There is NO Book!');
        }

        $bookreview = $this->bookReviewRepository->getBookReviewByBookId($id);

        if($bookreview->isEmpty()) {
            return $this->sendResponse($bookreview, 'This Book has No Review!');
        }
        else {

            return $this->sendResponse($bookreview, 'Bookreview By Book ID!');
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
