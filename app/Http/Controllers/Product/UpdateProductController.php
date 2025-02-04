<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\UpdateProductService;
use Illuminate\Http\RedirectResponse;

final class UpdateProductController extends Controller
{
    public function __invoke(
        ProductRequest $request,
        UpdateProductService $updateProductService,
        string $uuid
    ): RedirectResponse
    {
        try {
            $updatedProduct = $updateProductService($request->validated(), $uuid);
            logger()->notice("The product $updatedProduct->id was updated.");

            return redirect()
                ->route('products.index')
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            logger()->error(
                'There was an error updating the product id: ' . $uuid,
                [$e->getMessage()]
            );

            return back()->withErrors(
                ['error' => 'Something went wrong. Please try again.']
            )->withInput();
        }
    }
}
