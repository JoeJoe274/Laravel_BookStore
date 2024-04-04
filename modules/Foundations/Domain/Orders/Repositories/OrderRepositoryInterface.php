<?php

namespace BookStore\Foundations\Domain\Orders\Repositories;

interface OrderRepositoryInterface
{
    public function getOrders(array $params);

    public function getTotal(array $params);

    public function getOrderById($id);
}
