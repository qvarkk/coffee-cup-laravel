<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\StoreRequest;
use App\Models\Cart;
use App\Models\Product;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product, StoreRequest $request)
    {
        $data = $request->validated();

        Cart::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'quantity' => $data['quantity']
        ]);

        return response('success', 200);
    }
}
