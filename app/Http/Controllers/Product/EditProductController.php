<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

final class EditProductController extends Controller
{
    public function __invoke(string $uuid): InertiaResponse
    {

        $product = app(Product::class)->find($uuid);

        return Inertia::render('Product/Edit', [
            'product' => $product
        ]);
    }
}
