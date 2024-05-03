<?php

namespace BookStore\Foundations\Domain\OrderDetails\Repositories\Eloquent;

use BookStore\Foundations\Domain\OrderDetails\Repositories\OrderDetailRepositoryInterface;
use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BookStore\Foundations\Domain\OrderDetails\OrderDetail;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    protected $orderdetail;

    public function __construct(orderdetail $model)
    {
        parent::__construct($model);
    }

    public function getOrderDetails(array $params)
    {
        return $this->Connection($params)
        ->orderBy('order_details.created_at', 'desc')
        ->whereNull('order_details.deleted_at')
        ->get();
    }

    public function getOrderDetailById($id)
    {
        return $this->connection()
        ->find($id);
    }

    // public function createOrderDetail(array $params)
    // {
    //     return $this->connection()
    //     ->create($params);
    // }

    public function getOrderDetailByOrderId($id)
    {
        return $this->connection()
        ->where('order_details.order_id', '=', $id)
        ->get();
    }

    public function getOrderDetailBy($attribute, $value)
    {
        return $this->connection()
            ->where($attribute, '=', $value)
            ->first();
    }

}
