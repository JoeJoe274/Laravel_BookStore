<?php

namespace BookStore\Foundations\Domain\Customers\Repositories\Eloquent;

use BookStore\Foundations\Domain\Customers\Repositories\CustomerRepositoryInterface;
use BookStore\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BookStore\Foundations\Domain\Customers\Customer;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    protected $customer;

    public function __construct(customer $model)
    {
        parent::__construct($model);
    }

    protected function getConnectionByCondition(array $params)
    {
        $connection = $this->connection();

        if (isset($params['since']) && strlen($params['since']) > 0) {
            $connection = $connection->where('created_at', '>=', $params['since']);
        }

        if (isset($params['until']) && strlen($params['until']) > 0) {
            $connection = $connection->where('created_at', '<=', $params['until']);
        }

        if(isset($params['name']) && strlen($params['name']) > 0) {
            $connection = $connection->where('name', '=', $params['name']);
        }

        if(isset($params['address']) && strlen($params['address']) > 0) {
            $connection = $connection->where('address', '=', $params['address']);
        }

        if(isset($params['city']) && strlen($params['city']) > 0) {
            $connection = $connection->where('city', 'like', '%' . $params['city'] . '%');
        }

        return $connection;
    }

    public function getCustomers(array $params)
    {
        return $this->getConnectionByCondition($params)
        ->orderBy('customers.created_at', 'asc')
        ->whereNull('customers.deleted_at')
        ->get();
    }

    public function getTotal(array $params)
    {
        return $this->getConnectionByCondition($params)
        ->count('customers.id');
    }

    public function getCustomerById($id)
    {
        return $this->connection()
        ->find($id);
    }

}
