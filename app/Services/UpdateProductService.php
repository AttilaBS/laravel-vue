<?php

namespace App\Services;

use App\Models\Product;

class UpdateProductService
{
    public function __invoke(array $productData, string $uuid): int|Product
    {
        $updated = app(Product::class)
            ->where('id', $uuid)
            ->where('owner_id', auth()->user()->id)
            ->update($productData);

        if ($updated === 1) {
            return app(Product::class)->find($uuid);
        }

        return $updated;
    }
}
