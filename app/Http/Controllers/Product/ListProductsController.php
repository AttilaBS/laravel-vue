<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ListProductsService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class ListProductsController extends Controller
{
    public function __invoke(
        ListProductsService $listProductsService,
        Request $request,
        int $perPage = 20
    ): InertiaResponse|SymfonyResponse {
        $user = auth()->user();
        if (! auth()->check()) {

            return Inertia::location(route('user.login-page'));
        }
        $search = $request->input('search');
        $products = $listProductsService($user, $search, $perPage);

        return Inertia::render('Home', [
            'products' => $products,
            'can' => [
                'editProduct' => $user->can('edit', Product::class),
                'destroyProduct' => $user->can('destroy', Product::class),
            ]
        ]);
    }
}
