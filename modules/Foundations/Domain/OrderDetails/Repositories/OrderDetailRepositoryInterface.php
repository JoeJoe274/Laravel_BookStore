<?php

namespace BookStore\Foundations\Domain\OrderDetails\Repositories;

interface OrderDetailRepositoryInterface
{
    public function getOrderDetails(array $params);

    public function getOrderDetailById($id);
}
