<?php

namespace BookStore\Foundations\Domain\OrderDetails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use BookStore\Foundations\Domain\Orders\Order;
use BookStore\Foundations\Domain\Books\Book;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'book_id',
        'qty',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected $hidden = ['deleted_at'];

    protected $casts = [
        'created_at'    =>    'datetime:Y-m-d H:i:s',
        'updated_at'    =>    'datetime:Y-m-d H:i:s'
    ];
}
