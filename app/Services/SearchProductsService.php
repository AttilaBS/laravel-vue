<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SearchProductsService
{
    // @todo make a parametrized query
    public function __invoke(array $searchCriteria, int $perPage): ?Collection
    {
        $userId = auth()->user()->id;

        return Cache::remember(
            "products-search-$userId",
            60,
            function () use ($userId) {
                return app(Product::class)
                    ->where('owner_id', $userId)
                    ->where('column', $searchCriteria)
                    ->get();
            });
    }
}
