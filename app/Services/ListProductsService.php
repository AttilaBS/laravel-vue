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
        if ($search) {
            return Product::query()
                ->when($search, function($query, $search) {
                    $query->where(function($query) use ($search) {
                        $query->where('name', 'ILIKE', "%{$search}%");
                        $query->orWhere('description', 'ILIKE', "%{$search}%");
                    });
                })
                ->select(['id', 'name', 'description', 'price', 'stock_quantity', 'created_at'])
                ->where('owner_id', $user->id)
                ->paginate($perPage)
                ->withQueryString();
        }

        return Cache::tags(['user:' . $user->id])->remember(
            'products-listing',
            120,
            static function() use ($user, $perPage) {
                return Product::query()
                    ->select(['id', 'name', 'description', 'price', 'stock_quantity', 'created_at'])
                    ->where('owner_id', $user->id)
                    ->paginate($perPage)
                    ->withQueryString();
            }
        );
    }
}
