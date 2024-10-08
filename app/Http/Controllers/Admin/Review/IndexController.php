<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $products = Product::all();

        return ProductResource::collection($products);
    }
}
