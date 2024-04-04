<?php

namespace BookStore\Api\OrderDetails\Validation;

use Illuminate\Support\Facades\Validator;

class OrderDetailValidator
{
    public function store(array $inputs)
    {
        return validator::make($inputs, [
            'order_id'  =>  ['required', 'int'],
            'book_id'   =>  ['required', 'int'],
            'qty'       =>  ['required', 'int']
        ]);
    }
}
