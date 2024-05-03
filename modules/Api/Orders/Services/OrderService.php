<?php

namespace BookStore\Api\Orders\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Api\Orders\Resources\OrderResource;
use BookStore\Foundations\Domain\Orders\Repositories\Eloquent\OrderRepository;
use BookStore\Foundations\Domain\OrderDetails\Repositories\Eloquent\OrderDetailRepository;
use BookStore\Foundations\Domain\Books\Repositories\Eloquent\BookRepository;
use BookStore\Foundations\Domain\Customers\Repositories\Eloquent\CustomerRepository;
use BookStore\Foundations\Domain\Orders\Order;


class OrderService extends BaseController
{
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        BookRepository $bookRepository,
        OrderDetailRepository $orderDetailRepository
    ){
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->bookRepository = $bookRepository;
        $this->orderDetailRepository = $orderDetailRepository;
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

    // public function getOrderById($id)
    // {
    //     // return 'service';
    //     $order = $this->orderRepository->getOrderById($id);

    //     if($order->isEmpty()) {
    //         return $this->sendResponse($order, 'There is NO DATA to Retrieve!');
    //     }
    //     else {
    //         $order = new OrderResource($order);
    //         return $this->sendResponse($order, 'Retrieved Order by ID Successfully!');
    //     }
    // }

    public function getOrderById($id)
    {
        // return 'service';
        $order = $this->orderRepository->getOrderById($id);

        if(!empty($order)) {

            $order = new OrderResource($order);

            $orderdetail = $this->orderDetailRepository->getOrderDetailByOrderId($id);

            if($orderdetail->isNotEmpty()) {

                return $this->sendResponse($order, 'Successfully retrieved Order with Order Detail!');
            }
            else {

                return $this->sendError($order, 'This Order has NO Order Detail!');
            }
        }
        else {
            return $this->sendResponse($order, 'There is NO DATA!', 404);
        }
    }

    // public function createOrder(array $params)
    // {
    //     // return 'service';
    //     $order = $this->orderRepository->insertGetId($params);
    //     $orderdetail = $this->orderDetailRepository->insertGetId($params);
    //     return $this->sendResponse($order, 'Order is Created Successfully!', 0, 201);
    // }

    // public function updateOrder(array $params, $id)
    // {
    //     // return 'service';
    //     $order = $this->orderRepository->getOrderById($id);
    //     if(empty($order)) {
    //         return $this->sendError('NO DATA!', 'There is NO DATA!', 404);
    //     }

    //     $this->orderRepository->update($id, $params);

    //     $order = $this->orderRepository->getOrderById($id);

    //     $results = new OrderResource($order);
    //     return $this->sendResponse($results, 'Order is Updated Successfully!', 201);
    // }

    // public function deleteOrder($id)
    // {
    //     // return 'service';
    //     $order = $this->orderRepository->getOrderByID($id);
    //     if(empty($order)) {
    //         return $this->sendError('NO DATA!', 'There is NO DATA to DELETE!', 404);
    //     }

    //     $order = $this->orderRepository->delete($id);
    //     return $this->sendResponse($order, 'Order is DELETED Successfully!', 200);
    // }

    public function createOrder(array $params)
    {
        $data = isset($params['data']) ? json_decode($params['data']) : null;

        if(empty($data)) {
            return $this->sendError('No Data!',
        ['data' => 'There is NO record for data'], '400');
        }

        $customerId = isset($params['customer_id']) ? $params['customer_id'] : 0;

        $customer = $this->customerRepository->getCustomerById($customerId);

        if(empty($customer)) {
            return $this->sendError('No Data!',
        ['customer_id' => 'There is No record for this customer_id'], '400');
        }

        unset($params['data']);

        $order = [];
        $orderDetail = [];
        $orderId = 0;

        try {

            $orderId = $this->orderRepository->insertGetId($params);

            foreach($data as $item) {

                $orderDetail['order_id'] = $orderId;
                $orderDetail['book_id']  = $item->book_id;
                $orderDetail['qty']      = $item->qty;

                $book = $this->bookRepository->getBookById($item->book_id);

                if(empty($book)) {
                    return $this->sendError('No Data!',
                ['book_id' => 'There is No record for this book_id'], '400');
                }

                $this->orderDetailRepository->insertGetId($orderDetail);
            }
        }
        catch(\Exception $e) {
            dd($e->getMessage());
        }

        return $this->sendResponse($orderId, 'Created Order Successfully!', 0, 201);
    }

    public function updateOrder(array $params, $id)
    {
        // dd('update');

        $data = isset($params['data']) ? json_decode($params['data']) : null;

        if(empty($data)) {
            return $this->sendError('No Data!',
        ['data' => 'There is No Record for Data!'], '400');
        }

        $order = $this->orderRepository->getOrderById($id);

        if(empty($order)) {
            return $this->sendError($order, 'There is No record to Retrieve!', 404);
        }

        $customerId = isset($params['customer_id']) ? $params['customer_id'] : 0;

        $customer = $this->customerRepository->getCustomerById($customerId);

        if(empty($customer)) {
            return $this->sendError('No Data!',
        ['customer_id' => 'There is No Record for this Customer_Id'], '400');
        }

        unset($params['data']);

        $order       = [];
        $orderDetail = [];
        $orderId     = 0;

        $this->orderRepository->beginTransaction();

        try {
            $orderDetails = $this->orderDetailRepository->getOrderDetailBy('order_id', $id);

            if(!empty($orderDetails)) {
                $this->orderDetailRepository->deleteBy('order_id', $id);
            }

            foreach($data as $item) {

                $orderDetail['order_id'] = $id;
                $orderDetail['book_id']  = $item->book_id;
                $orderDetail['qty']      = $item->qty;

                $book = $this->bookRepository->getBookById($item->book_id);

                if(empty($book)) {
                    return $this->sendError('No Data!',
                ['book_id' => 'There is No record for this Book_id'], '400');
                }
                // dd($orderDetail);
                $this->orderDetailRepository->insertGetId($orderDetail);
            }
            // dd($params);
            $order['amount'] = $params['amount'];

            $this->orderRepository->update($id, $order);

            $this->orderRepository->commit();

            return $this->sendResponse($orderDetail, 'Updated Successfully!', 0, 201);

        }
        catch(\Exception $e) {
            dd($e->getMessage());
            // $this->orderRepository->rollback();
        }


    }

    public function deleteOrder($id)
    {
        $order = $this->orderRepository->getOrderById($id);

        if(empty($order)) {
            return $this->sendError($order, 'There is No Record to Retrieve!', 404);
        }

        $this->orderRepository->beginTransaction();

        try{

            $orderDetails = $this->orderDetailRepository->getOrderDetailBy('order_id', $id);

            if(!empty($orderDetails)) {
                $this->orderDetailRepository->deleteBy('order_id', $id);
            }

            $result = $this->orderRepository->delete($id);

            $this->orderRepository->commit();

            return $this->sendResponse($result, 'Order deleted Successfully!');
        }
        catch(\Exception $e) {
            $this->orderRepository->rollback();
        }
    }
}
