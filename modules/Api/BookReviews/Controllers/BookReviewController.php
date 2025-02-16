<?php

namespace BookStore\Api\BookReviews\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Foundations\Domain\BookReviews\BookReview;
use BookStore\Api\BookReviews\Services\BookReviewService;
use BookStore\Api\BookReviews\Validation\BookReviewValidator;

class BookReviewController extends BaseController
{
    const ATTRIBUTES = [
        'book_id',
        'description'
    ];

    public function __construct(
        BookReviewService $service,
        BookReviewValidator $validator
    ) {
        $this->service = $service;
        $this->validator = $validator;
    }

    public function index(Request $request)
    {
            $inputsSpecification = $request->only(
            'book_id',
            'description'
        );

        $results = $this->service->getBookReviews($inputsSpecification);

        return $results;
    }

    public function show($id)
    {
        $results = $this->service->getBookReviewById($id);

        return $results;
    }

    public function store(Request $request)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES), function($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->store($inputs);

        if($validation->fails()){
            return $this->sendError($validation->errors(), '', 400);
        }

        $results = $this->service->createBookReview($inputs);
        return $results;

    }

    public function delete($id)
    {
        $results = $this->service->deleteBookReview($id);

        return $results;
    }
}
