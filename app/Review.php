<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function product(){
        $this->belongsTo(Product::class ,"product_id") ; 
    }
}
