<?php

namespace App\Services;

use App\Models\Product;

class StoreProductService
{
    public function __invoke(array $productData): ?Product
    {
        $ownerId = auth()->user()->id;

        return app(Product::class)
            ->create(
                [
                    'name' => $productData['name'],
                    'email' => $productData['email'],
                    'cpf' => $productData['cpf'],
                    'city' => $productData['city'],
                    'state' => $productData['state'],
                    'manager_id' => $ownerId,
                ]
            );
    }
}
