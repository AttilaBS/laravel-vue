<?php

namespace App\Services;

use App\Models\Product;

class StoreProductService
{
    public function __invoke(array $productData): ?Product
    {

        return app(Product::class)
            ->create(
                [
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock_quantity' => $productData['stock_quantity'],
                    'owner_id' => auth()->user()->id,
                ]
            );
    }
}
