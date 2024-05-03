<?php

namespace BookStore\Foundations\Domain\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use BookStore\Foundations\Domain\Orders\Order;

class Customer extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'address',
        'city'
    ];

}
