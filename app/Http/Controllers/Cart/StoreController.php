<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        Cart::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'quantity' => 1
        ]);

        return response('success', 200);
    }
}
