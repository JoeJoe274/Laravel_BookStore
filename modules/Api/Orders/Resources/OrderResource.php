<?php

namespace BookStore\Api\Orders\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request):array
    {
        return [
            'order_id'      =>   $this->id,
            'customer_id'   =>   $this->customer_id,
            'amount'        =>   $this->amount,
            'date'          =>   $this->date,
            'created_at'    =>   $this->created_at->format('Y:m:d h:i:s'),
            'updated_at'    =>   $this->updated_at->format('Y:m:d h:i:s'),
            'detail'        =>   $this->details()->first()
        ];
    }
}
