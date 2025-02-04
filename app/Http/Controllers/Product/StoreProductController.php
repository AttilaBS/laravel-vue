<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\StoreProductService;
use Exception;
use Illuminate\Http\RedirectResponse;

final class StoreProductController extends Controller
{
    public function __invoke(
        ProductRequest $request,
        StoreProductService $storeProductService
    ): RedirectResponse {
        try {
            $product = $storeProductService($request->validated());
            logger()->notice("The product $product->id was created.");

            return redirect()
                ->route('products.index')
                ->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            logger()->error(
                'There was an error creating the product: ',
                [$e->getMessage()]
            );

            return back()->withErrors(
                ['error' => 'Something went wrong. Please try again.']
            )->withInput();
        }
    }
}
