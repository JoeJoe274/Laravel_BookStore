<?php

namespace BookStore\Api\BookReviews\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'book_id'       =>   $this->id,
            'description'   =>   $this->description,
            'created_at'    =>   $this->created_at->format('Y-m-d h:i:s'),
            'updated_at'    =>   $this->updated_at->format('Y-m-d h:i:s'),
            'book'          =>   $this->book()->first()
        ];
    }
}
