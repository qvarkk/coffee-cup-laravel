<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product, UpdateRequest $request)
    {
        $data = $request->validated();

        $product->update($data);

        return new ProductResource($product->fresh());
    }
}
