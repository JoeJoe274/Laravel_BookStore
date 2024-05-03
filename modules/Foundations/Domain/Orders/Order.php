<?php

namespace BookStore\Foundations\Domain\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use BookStore\Foundations\Domain\OrderDetails\OrderDetail;
use BookStore\Foundations\Domain\Customers\Customer;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'amount',
        'date',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
