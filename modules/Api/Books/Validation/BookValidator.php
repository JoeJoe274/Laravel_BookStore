<?php

namespace BookStore\Api\Books\Validation;

use Illuminate\Support\Facades\Validator;

class BookValidator
{
    public function store(array $inputs)
    {
        return Validator::make($inputs, [
            'ISBN'   => ['required'],
            'author' => ['required'],
            'title'  => ['required'],
            'price'  => ['required', 'int']
        ]);
    }

    public function update(array $inputs)
    {
        return Validator::make($inputs, [
            'ISBN'   => ['max:100'],
            'author' => ['max:100'],
            'title'  => ['max:100'],
            'price'  => ['int']
        ]);
    }

    public function upload(array $inputs)
    {
        return Validator::make($inputs, [
            'file' => ['required', 'mimes:png,jpeg,jpg']
        ]);
    }
}
