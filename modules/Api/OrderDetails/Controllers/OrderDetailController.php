<?php

namespace BookStore\Api\OrderDetails\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Foundations\Domain\OrderDetails\OrderDetail;
use BookStore\Api\OrderDetails\Services\OrderDetailService;
use BookStore\Api\OrderDetails\Validation\OrderDetailValidator;

class OrderDetailController extends BaseController
{
    const ATTRIBUTES = [
        'order_id',
        'book_id',
        'qty'
    ];

    public function __construct(
        OrderDetailService $service,
        OrderDetailValidator $validator
    ){
        $this->service = $service;
        $this->validator = $validator;
    }

    public function index(Request $request)
    {
        $inputsSpecification = $request->only(
            'order_id',
            'book_id',
            'qty'
        );

        $results = $this->service->getOrderDetails($inputsSpecification);

        return $results;
    }

    public function show($id)
    {
        $results = $this->service->getOrderDetailById($id);

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

        $results = $this->service->createOrderDetail($inputs);
        return $results;
    }

    public function delete($id)
    {
        $results = $this->service->deleteOrderDetail($id);

        return $results;
    }
}
