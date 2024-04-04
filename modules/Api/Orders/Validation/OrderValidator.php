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
            'date'         =>  ['required']
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
