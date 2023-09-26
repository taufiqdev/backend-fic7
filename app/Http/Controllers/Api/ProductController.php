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
    public function index(Request $request)
    {
            //return Product::paginate(10);
            
            /* $categoryId = $request->input('category_id');
            $products = Product::when(
                $categoryId,
                fn ($query, $categoryId) => $query->categoryId($categoryId)
            )->paginate()->load('category');
             */
            $categoryId=$request->input('category_id');
            $userId=$request->input('user_id');
            /* $products=Product::when (
                $categoryId, fn($query, $categoryId, $userId)=>$query->categoryId($categoryId, $userId)
            )->paginate()->load('category', 'user'); */
            $products=Product::where('category_id', 'LIKE', '%'.$categoryId.'%')
            ->where('user_id', 'LIKE', '%'.$userId.'%')->paginate()->load('category', 'user');
            
            return ProductResource::collection($products);
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
