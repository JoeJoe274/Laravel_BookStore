<?php

namespace BookStore\Foundations\Domain\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    // public function bookreview()
    // {
    //     return $this->hasOne(BookReview::class);
    // }

}
