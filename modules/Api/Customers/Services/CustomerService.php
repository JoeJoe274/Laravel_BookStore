<?php

namespace BookStore\Api\Customers\Services;

use BookStore\Api\Common\BaseController;
use BookStore\Foundations\Domain\Customers\Repositories\Eloquent\CustomerRepository;
use BookStore\Api\Customers\Resources\CustomerResource;
use BookStore\Foundations\Domain\Customers\Customer;

class CustomerService extends BaseController
{
    protected $customerRepository;

    public function __construct(
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers(array $params) {

        $customers = $this->customerRepository->getCustomers($params);

        if ($customers->isNotEmpty()) {

            $customers = CustomerResource::collection($customers);

            $total = $this->customerRepository->getTotal($params);

            return $this->sendResponse($customers, 'Customers Retrieved Successfully!', $total);

        } else {

            $customers = [];

            return $this->sendResponse($customers, 'There is NO Date for Customer!');

        }

    }

    public function getCustomerById($id)
    {
        $customerbyid = $this->customerRepository->getCustomerById($id);

        if(!empty($customerbyid)) {

            $customerbyid = new CustomerResource($customerbyid);

            return $this->sendResponse($customerbyid, 'Retrieved by CustomersID Successfully!');
        }
        else {

            return $this->sendError($customerbyid, 'There is NO Data!');
        }
    }

    public function createCustomer(array $params)
    {
        $create = $this->customerRepository->insertGetId($params);

        return $this->sendResponse($create, 'Customer created Successfully!', 0, 201);
    }

    public function updateCustomer(array $params, $id)
    {
        $customer = $this->customerRepository->getCustomerById($id);

        if(empty($customer)) {
            return $this->sendResponse($customer, 'There is NO Date to Update!');
        }
        $update = $this->customerRepository->update($id, $params);

        $update = $this->customerRepository->getCustomerById($id);
        $update = new CustomerResource($update);

        return $this->sendResponse($update, 'Customer Updated Successfully!', 201);
    }

    public function deleteCustomer($id)
    {
        $customer = $this->customerRepository->getCustomerById($id);

        if(!empty($customer)) {

            $customer = $this->customerRepository->delete($id);

            return $this->sendResponse($customer, 'Customer deleted Successfully!', 200);

        } else {

            return $this->sendError($customer, 'There is No Data!', 404);

        }
    }
}
