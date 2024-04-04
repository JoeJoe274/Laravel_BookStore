<?php

namespace BookStore\Api\OrderDetails\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Foundations\Domain\OrderDetails\OrderDetail;
use BookStore\Api\OrderDetails\Services\OrderDetailService;

class OrderDetailController extends BaseController
{
    public function __construct(
        OrderDetailService $service
    ){
        $this->service = $service;
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

    public function delete($id)
    {
        $results = $this->service->deleteOrderDetail($id);

        return $results;
    }
}
