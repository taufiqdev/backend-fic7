<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            //return Product::paginate(10);
            return ProductResource::collection(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
      $product=Product::create([
        ...$request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string',
            'price' => 'required',
            'image_url' =>'required',
            'category_id' =>'required',
        ]),
        'user_id'=>1,
      ]);

      return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //return $product;
        //return $product->load('category', 'user');
        $product->load('category', 'user');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product=Product::update([
            $request->validate([
                'name' => 'required|string|max:30',
                'description' => 'required|string',
                'price' => 'required',
                'image_url' =>'required',
                'category_id' =>'required',
            ]),
            'user_id'=>1,
        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(status: 204);
    }
}
