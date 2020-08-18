<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name"=>$this->name , 
            "description"=>$this->details, 
            "price"=>$this->price , 
            "stock"=>$this->stock==0?"out of stock":$this->stock , 
            "discount"=>$this->discount , 
            "total_price"=>(1-($this->discount/100))*$this->price , 
            "rate"=>$this->reviews->count()>0 ? round($this->reviews->sum("star")/$this->reviews->count(),1):"no rating yet" ,
            "href"=>[
                "reviews" =>route("review.index",$this->id) 
            ]
        ] ; 
    }
}
