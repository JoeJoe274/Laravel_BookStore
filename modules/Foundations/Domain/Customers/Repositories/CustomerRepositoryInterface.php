<?php

namespace BookStore\Foundations\Domain\Customers\Repositories;

interface CustomerRepositoryInterface
{
    public function getCustomers(array $params);

    public function getTotal(array $params);

    public function getCustomerById($id);
}
