<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name"=>$faker->word(),
        "details"=>$faker->sentence(300) ,
        "price"=>$faker->numberBetween(100,2000) , 
        "stock"=>$faker->randomDigit     , 
        "discount"=>$faker->numberBetween(2,30), 
        "user_id"=>function(){
            return User::all()->random() ; 
        } 
    ];
});
