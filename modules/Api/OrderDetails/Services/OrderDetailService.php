<?php

namespace BookStore\Api\OrderDetails\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Api\OrderDetails\Resources\OrderDetailResource;
use BookStore\Foundations\Domain\OrderDetails\OrderDetail;
use BookStore\Foundations\Domain\OrderDetails\Repositories\Eloquent\OrderDetailRepository;
use Exception;

class OrderDetailService extends BaseController
{
    protected $orderDetailRepository;

    public function __construct(
        OrderDetailRepository $orderDetailRepository
    ) {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function getOrderDetails(array $params)
    {
        $orderdetail = $this->orderDetailRepository->getOrderDetails($params);

        if($orderdetail->isNotEmpty()) {

            $orderdetail = OrderDetailResource::collection($orderdetail);

            return $this->sendResponse($orderdetail, 'Retrieve Order Details Successfully!');
        }
        else {
            return $this->sendResponse($orderdetail, 'There is NO Data!');
        }
    }

    public function getOrderDetailById($id)
    {
        $orderdetail = $this->orderDetailRepository->getOrderDetailById($id);

        if(!empty($orderdetail)) {
            $orderdetail = new OrderDetailResource($orderdetail);

            return $this->sendResponse($orderdetail, 'Retrieve Order Detail By ID Successfully!');
        }
        else {
            return $this->sendResponse($orderdetail, 'There is NO Data!');
        }
    }

    public function deleteOrderDetail($id)
    {
        $orderdetail = $this->orderDetailRepository->getOrderDetailById($id);

        if(!empty($orderdetail)) {
            $orderdetail = $this->orderDetailRepository->delete($id);

            return $this->sendResponse($orderdetail, 'Order Detail is DELETED Successfully!', 200);
        }
        else {
            return $this->sendResponse($orderdetail, 'There is NO Data to DELETE!', 201);
        }
    }
}
