<?php

namespace App\Services;

use App\Models\Product;

class DeleteProductService
{
    public function __invoke(string $uuid): int
    {
        return app(Product::class)
            ->where('id', $uuid)
            ->where('owner_id', auth()->user()->id)
            ->delete();
    }
}
