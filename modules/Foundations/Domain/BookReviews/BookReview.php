<?php

namespace BookStore\Foundations\Domain\BookReviews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookReview extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'description'
    ];

    // public function book()
    // {
    //     return $this->belongsTo(Book::class);
    // }
}
