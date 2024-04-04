<?php

namespace BookStore\Foundations\Domain\OrderDetails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'order_id',
        'book_id',
        'qty',
    ];
}
