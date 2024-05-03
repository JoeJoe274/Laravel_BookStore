<?php

namespace BookStore\Api\Orders\Validation;

use Illuminate\Support\Facades\Validator;

class OrderValidator
{
    public function store(array $inputs)
    {
        return Validator::make($inputs, [
            'customer_id'  =>  ['required'],
            'amount'       =>  ['required', 'int'],
            'date'         =>  ['required', 'date_format:Y-m-d'],
            // 'order_id'     =>  ['required', 'int'],
            // 'book_id'      =>  ['required', 'int'],
            // 'qty'          =>  ['required', 'int']
        ]);
    }

    public function update(array $inputs)
    {
        return Validator::make($inputs, [
            'customer_id'  =>  ['max:100'],
            'amount'       =>  ['max:100', 'int'],
            'date'         =>  ['max:100']
        ]);
    }
}
