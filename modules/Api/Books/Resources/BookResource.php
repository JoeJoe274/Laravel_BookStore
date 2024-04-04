<?php

namespace BookStore\Api\Books\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           =>   $this->id,
            'ISBN'         =>   $this->ISBN,
            'author'       =>   $this->author,
            'title'        =>   $this->title,
            'price'        =>   $this->price,
            'cover_url'    =>   $this->cover_url? env('S3_URL_PREFIX') . env('S3_PREFIX') .
                                'books/' . $this->id . '/' . $this->cover_url :'',
            'created_at'   =>   $this->created_at->format('Y-m-d h:i:s'),
            'updated_at'   =>   $this->updated_at->format('Y-m-d h:i:s'),
            // 'book_review'  =>   $this->BookReview()->first()
        ];
    }
}
