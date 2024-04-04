<?php

namespace BookStore\Api\BookReviews\Validation;

use Illuminate\Support\Facades\Validator;

class BookReviewValidator
{
    public function store(array $inputs)
    {
        return validator::make($inputs, [
            'book_id'      =>  ['required', 'int'],
            'description'  =>  ['required', 'max:20']
        ]);
    }
}
