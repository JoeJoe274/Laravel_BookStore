<?php

namespace BookStore\Foundations\Domain\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use BookStore\Foundations\Domain\BookReviews\BookReview;
use BookStore\Foundations\Domain\OrderDetails\OrderDetail;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    const S3_IMAGE_DIRECTORY = 'books';

    protected $fillable= [
        'ISBN',
        'author',
        'title',
        'price'
    ];

    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
