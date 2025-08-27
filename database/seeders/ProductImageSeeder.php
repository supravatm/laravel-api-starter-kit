<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Api\ProductImage;
use App\Models\Api\Product;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = Product::all();
        foreach($products as $product)
        {
            ProductImage::create([
                'path' => 'products/'.strtr($product->name,' ','_').'.jpeg',
                'product_id' => $product->id,
                'status' => 1
            ]);
        }

        
    }
}
