<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ListProductsService
{
    public function __invoke(User $user, int $perPage): ?Collection
    {

        return Product::all();

//        return Cache::remember(
//            "products-listing-$userId",
//            60,
//            function () use ($userId, $perPage) {
//                return app(Product::class)
//                    ->where('owner_id', $userId)
//                    ->paginate($perPage);
//            });
    }
}
