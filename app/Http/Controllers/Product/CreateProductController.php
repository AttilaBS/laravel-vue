<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

final class CreateProductController extends Controller
{
    public function __invoke(): InertiaResponse
    {

        return Inertia::render('Product/Create');
    }
}
