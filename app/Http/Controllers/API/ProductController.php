<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ProductCollection;
use App\Models\Api\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['images'])->paginate();
        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());
        return $this->success(
            new ProductResource($product),
            'Product created successfully', 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::whereHas('images')->find($id);
        if(!$product)
        {
            return $this->error(
                'Product not found',
                422
            );
        }
        return $this->success(
            new ProductResource($product),
            'Product retrieved successfully', 
            200
        );

        return $this->error("Requested product not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());
        
        return $this->success(
            new ProductResource($product),
            'Product updated successfully', 
            202
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->success(
            [],
            'Product deleted successfully',
            202
        );
    }
}