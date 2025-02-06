<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ListProductsService
{
    public function __invoke(
        User $user,
        int $currentPage,
        int $perPage,
        ?string $search
    ): LengthAwarePaginator {
        if ($search) {
            return Product::query()
                ->where('owner_id', $user->id)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'ILIKE', "%$search%")
                        ->orWhere('description', 'ILIKE', "%$search%");
                })
                ->select(['id', 'name', 'description', 'price', 'stock_quantity', 'created_at'])
                ->paginate($perPage)
                ->withQueryString();
        }
        // If there is no search parameter, it will cache the products for faster browsing
        $ids = Cache::tags(['user:' . $user->id])
            ->remember(
                'products-listing',
                now()->addMinutes(5),
                fn () => Product::where('owner_id', $user->id)->pluck('id')->toArray()
            );

        $totalProducts = count($ids);
        if ($totalProducts === 0) {
            return new LengthAwarePaginator([], 0, $perPage, $currentPage);
        }

        $pagedIds = array_slice($ids, ($currentPage - 1) * $perPage, $perPage);

        $products = Product::whereIn('id', $pagedIds)
            ->select(['id', 'name', 'description', 'price', 'stock_quantity', 'created_at'])
            ->orderByRaw(
                "ARRAY_POSITION(
                        ARRAY[" . implode(
                        ',',
                        array_map(static fn($id) => "'$id'", $pagedIds)
                        ) . "]::uuid[], id)"
            )
            ->get();

        return new LengthAwarePaginator(
            $products,
            $totalProducts,
            $perPage,
            $currentPage
        );
    }
}
