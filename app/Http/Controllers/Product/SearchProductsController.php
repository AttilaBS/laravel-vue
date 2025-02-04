<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\SearchProductsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

final class SearchProductsController extends Controller
{
    //@todo make a parametrized query
    public function __invoke(
        SearchProductsService $searchProductsService,
        int $perPage = 50
    ): RedirectResponse {
        $products = $searchProductsService($perPage);

        return Inertia::render('Products/Index', [
            'posts' => $products,
        ]);
    }
}
