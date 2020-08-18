<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        "customer"=>$faker->name() , 
        "review"=>$faker->sentence(200) , 
        "star"=>$faker->numberBetween(0,5) , 
        "product_id"=>function(){
            return Product::all()->random() ;
        }
    ];
});
