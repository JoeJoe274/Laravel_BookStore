<?php

namespace BookStore\Api\Customers\Validation;

use Illuminate\Support\Facades\Validator;

class CustomerValidator
{
    public function store(array $inputs)
    {
        return Validator::make($inputs, [
            'name'    => ['required'],
            'address' => ['required'],
            'city'    => ['required']
        ]);
    }

    public function update(array $inputs)
    {
        return Validator::make($inputs, [
            'name'  => ['max:100'],
            'address' => ['max:100'],
            'city'    => ['max:100']
        ]);
    }
}
