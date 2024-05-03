<?php

namespace BookStore\Api\Orders\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Api\Orders\Services\OrderService;
use BookStore\Api\Orders\Validation\OrderValidator;
use BookStore\Api\OrderDetails\Validation\OrderDetailValidator;
use BookStore\Foundations\Domain\Orders\Order;

class OrderController extends BaseController
{
    const ATTRIBUTES = [
        'customer_id',
        'amount',
        'date',
        'order_id',
        'book_id',
        'qty',
        'data'
    ];

    public function __construct(
        OrderService $service,
        OrderValidator $validator,
        OrderDetailValidator $detailvalidator
    ){
        $this->service = $service;
        $this->validator = $validator;
        $this->detailvalidator = $detailvalidator;
    }

    public function index(Request $request)
    {
        $inputsSpecification = $request->only(
            'customer_id',
            'amount',
            'date',
        );

        $results = $this->service->getOrders($inputsSpecification);
        return $results;
    }

    public function show($id)
    {
        $result = $this->service->getOrderById($id);
        return $result;
    }

    public function store(Request $request)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES),
        function ($v){
            return $v !== null;
        });

        $validation = $this->validator->store($inputs);
        if($validation->fails()){
            return $this->sendError($validation->errors(), '', 404);
        }

        $results = $this->service->createOrder($inputs);
        return $results;
    }

    public function update(Request $request, $id)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES),
        function ($v){
            return $v !== null;
        });

        $validation = $this->validator->update($inputs);
        if($validation->fails()){
            return $this->sendError($validation->errors(), '', 404);
        }

        $results = $this->service->updateOrder($inputs, $id);
        return $results;
    }

    public function delete(Request $request, $id)
    {
        $order = $this->service->deleteOrder($id);
        return $order;
    }
}
