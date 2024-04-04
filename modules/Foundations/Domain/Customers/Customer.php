<?php

namespace BookStore\Foundations\Domain\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'address',
        'city'
    ];
}
