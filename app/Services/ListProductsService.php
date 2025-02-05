<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ListProductsService
{
    public function __invoke(User $user, ?string $search, int $perPage): LengthAwarePaginator
    {
        return Product::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                    $query->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->select(['id', 'name', 'description', 'price', 'stock_quantity', 'created_at'])
            ->where('owner_id', $user->id)
            ->paginate($perPage)
            ->withQueryString();

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
