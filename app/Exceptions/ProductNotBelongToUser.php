<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductNotBelongToUser extends Exception
{
    public function render(){
        return response()->json([
            "notauthorized"=>"this data is not authorized"
        ],Response::HTTP_NON_AUTHORITATIVE_INFORMATION) ; 
    }
}
