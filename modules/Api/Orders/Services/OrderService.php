<?php

namespace BookStore\Api\Orders\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Api\Orders\Resources\OrderResource;
use BookStore\Foundations\Domain\Orders\Repositories\Eloquent\OrderRepository;
use BookStore\Foundations\Domain\Orders\Order;
use Exception;

class OrderService extends BaseController
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository
    ){
        $this->orderRepository = $orderRepository;
    }

    public function getOrders(array $params)
    {
        // return 'service';
        $orders = $this->orderRepository->getOrders($params);

        if($orders->isNotEmpty()) {

            $orders = OrderResource::collection($orders);
            $total = $this->orderRepository->getTotal($params);
            return $this->sendResponse($orders, 'Retrieved Orders Successfully!', $total);
        }
        else {
            $orders = [];
            return $this->sendResponse($orders, 'There is NO DATA to Retrieve!');
        }
    }

    public function getOrderById($id)
    {
        // return 'service';
        $order = $this->orderRepository->getOrderById($id);

        if(!empty($order)) {

            $order = new OrderResource($order);
            return $this->sendResponse($order, 'Retrieved Order by ID Successfully!');
        }
        else {
            return $this->sendResponse($order, 'There is NO DATA to Retrieve!');
        }
    }

    public function createOrder(array $params)
    {
        // return 'service';
        $order = $this->orderRepository->insertGetId($params);
        return $this->sendResponse($order, 'Order is Created Successfully!', 0, 201);
    }

    public function updateOrder(array $params, $id)
    {
        // return 'service';
        $order = $this->orderRepository->getOrderById($id);
        if(empty($order)) {
            return $this->sendError('NO DATA!', 'There is NO DATA!', 404);
        }

        $this->orderRepository->update($id, $params);

        $order = $this->orderRepository->getOrderById($id);

        $results = new OrderResource($order);
        return $this->sendResponse($results, 'Order is Updated Successfully!', 201);
    }

    public function deleteOrder($id)
    {
        // return 'service';
        $order = $this->orderRepository->getOrderByID($id);
        if(empty($order)) {
            return $this->sendError('NO DATA!', 'There is NO DATA to DELETE!', 404);
        }

        $order = $this->orderRepository->delete($id);
        return $this->sendResponse($order, 'Order is DELETED Successfully!', 200);
    }
}
