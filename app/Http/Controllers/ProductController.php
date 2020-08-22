<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\product\ProductCollection;
use App\Http\Resources\product\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:api"])->only(["store","update","delete"]) ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(Product::paginate(20)) ;
        //return  new ProductCollection(Product::all()) ; if we use the default collection class

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product=Product::create([
            "name"=>$request->name ,
            "details"=>$request->description,
            "price"=>$request->price ,
            "stock"=>$request->stock ,
            "discount"=>$request->discount , 
            "user_id"=>auth()->user()->id
        ]) ;
        if($product){
            return response([
                "data"=>new ProductResource($product)
            ],Response::HTTP_CREATED) ;
        }
        else
        {
            return "product failed to create" ;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return new ProductResource($product) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($product->user_id ==auth()->user()->id) {
            $request->validate([
                "name"=>"required|unique:products,name,$product->id" ,
                "description"=>"required",
                "price"=>"required" ,
                "stock"=>"required|max:6" ,
                "discount"=>"required|max:2"
            ]);
            $request["details"]=$request->description ;
            unset($request["description"]) ;
            $product->update($request->all()) ; 
            return response([
                    "data"=>new ProductResource($product)
                ]) ;
        }
        else
        {
            return response([
                "auth error"=>"you can not access this data"
            ],Response::HTTP_NON_AUTHORITATIVE_INFORMATION) ;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->user_id == auth()->user()->id){
            $product->delete() ;
            return response(null,Response::HTTP_NO_CONTENT) ;  
        }  
        else
        {
            return response([
                "auth error"=>"you can not access this data"
            ],Response::HTTP_NON_AUTHORITATIVE_INFORMATION) ;
        }
    }
}
