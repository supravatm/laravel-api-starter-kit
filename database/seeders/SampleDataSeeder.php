<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\Product;
use App\Models\Api\ProductImage;
use App\Models\Api\OrderDelivery;
use App\Models\Api\Order;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear tables
        Product::truncate();
        ProductImage::truncate();
        OrderDelivery::truncate();
        Order::truncate();

        // 1. Create products
        Product::factory()->count(5)->create();

        // 2. Assign image of products
        $products = Product::all();
        foreach($products as $product)
        {
            ProductImage::create([
                'path' => 'products/'.strtr($product->name,' ','_').'.jpeg',
                'product_id' => $product->id,
                'default' => 1,
                'status' => 1
            ]);
        }

        // Create order
        Order::factory()->count(5)->create();

        // Create Carrier 
        OrderDelivery::factory()->count(5)->create();
        
    }
}
