<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenericResource;
use App\Services\DeleteProductService;
use Exception;
use Illuminate\Http\RedirectResponse;

final class DeleteProductController extends Controller
{
    public function __invoke(
        string $uuid,
        DeleteProductService $deleteProductService
    ): RedirectResponse {
        try {
            $deleteProductService($uuid);
            logger()->notice("The product id $uuid was removed by user id " . auth()->user()->id);

            return redirect()
                ->route('products.index')
                ->with('success', 'Product removed successfully.');
        } catch (Exception $e) {
            logger()->error("There was an error while deleting the product id:  $uuid.");

            return back()->withErrors(
                ['error' => 'Something went wrong. Please try again.']
            )->withInput();
        }
    }
}
