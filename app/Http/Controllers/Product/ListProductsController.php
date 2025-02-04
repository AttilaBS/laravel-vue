<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ListProductsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

final class ListProductsController extends Controller
{
    public function __invoke(
        ListProductsService $listProductsService,
        int $perPage = 50
    ): InertiaResponse {
        $user = auth()->user();
        $products = $listProductsService($user, $perPage);

        return Inertia::render('Home', [
            'products' => $products,
            'auth' => ['user' => $user],
        ]);
    }
}
