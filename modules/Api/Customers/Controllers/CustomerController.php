<?php

namespace BookStore\Api\Customers\Controllers;

use Illuminate\Http\Request;
use BookStore\Api\Common\BaseController as BaseController;
use BookStore\Foundations\Domain\Customers\Customer;
use BookStore\Api\Customers\Services\CustomerService;
use BookStore\Api\Customers\Validation\CustomerValidator;

class CustomerController extends BaseController
{
    const ATTRIBUTES = [
        'name',
        'address',
        'city'
    ];

    public function __construct(
        CustomerValidator $validator,
        CustomerService $service
    ){
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $inputsSpecification = $request->only(
            'name',
            'address',
            'city',
            'since',
            'until'
        );

        $results = $this->service->getCustomers($inputsSpecification);

        return $results;
    }

    public function show($id)
    {
        $results = $this->service->getCustomerById($id);

        return $results;
    }

    public function store(Request $request)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES), function($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->store($inputs);

        if($validation->fails()) {

            return $this->sendError($validation->errors(), '', 400);
        }

        $results = $this->service->createCustomer($inputs);

        return $results;
    }

    public function update(Request $request, $id)
    {
        $inputs = array_filter($request->only(self::ATTRIBUTES), function($v)
        {
            return $v !== null;
        });

        $validation = $this->validator->update($inputs);

        if($validation->fails()) {

            return $this->sendError($validation->errors(), '', 400);
        }

        $results = $this->service->updateCustomer($inputs, $id);

        return $results;
    }

    public function delete($id)
    {
        $results = $this->service->deleteCustomer($id);

        return $results;
    }
}
