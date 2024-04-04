<?php

namespace BookStore\Api\Books\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Foundations\Domain\Books\Book;
use BookStore\Api\Books\Services\BookService;
use BookStore\Api\Books\Validation\BookValidator;

class BookController extends BaseController
{

    const ATTRIBUTES = [
        'ISBN',
        'author',
        'title',
        'price'
    ];


    public function __construct(
        BookValidator $Validator,
        BookService $service
    ) {
        $this->validator = $Validator;
        $this->service = $service;
    }

    public function index(Request $request)
    {

        $inputsSpecification = $request->only(
            'ISBN',
            'author',
            'title',
            'since',
            'until'
        );

        $results = $this->service->getBooks($inputsSpecification);

        return $results;
    }

    public function show($id)
    {
        $results = $this->service->getBookById($id);

        return $results;
    }

    public function store(Request $request)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES), function($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->store($inputs);

        if($validation->fails()) {
            return $this->sendError($validation->errors(), '', 400);
        }

        $results = $this->service->createBook($inputs);

        return $results;
    }

    public function update(Request $request, $id)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES), function($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->update($inputs);

        if($validation->fails()) {
            return $this->sendError($validation->errors(), '', 400);
        }

        $results = $this->service->updateBook($inputs, $id);

        return $results;
    }

    public function delete($id)
    {
        $results = $this->service->deleteBook($id);

        return $results;
    }

    public function upload(Request $request, $id)
    {
        $inputsSpecification = $request->only(
            'file'
        );

        $validation=$this->validator->upload($inputsSpecification);

        if($validation->fails()){
            return $this->sendError($validation->errors(), '', 400);
        }

        $results = $this->service->uploadPicture($inputsSpecification, $id);

        return $results;
    }
}
