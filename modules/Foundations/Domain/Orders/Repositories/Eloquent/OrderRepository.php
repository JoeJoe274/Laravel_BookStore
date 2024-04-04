<?php

namespace BookStore\Foundations\Domain\Orders\Repositories\Eloquent;

use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BookStore\Foundations\Domain\Orders\Repositories\OrderRepositoryInterface;
use BookStore\Foundations\Domain\Orders\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $order;

    public function __construct(order $model)
    {
        parent::__construct($model);
    }

    public function getOrders(array $params)
    {
        return $this->connection()
        ->orderBy('orders.created_at', 'desc')
        ->whereNull('orders.deleted_at')
        ->get();
    }

    public function getTotal(array $params)
    {
        return $this->connection()
        ->count('orders.id');
    }

    public function getOrderById($id)
    {
        return $this->connection()
        ->find($id);
    }
}
