<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $cartItem = Cart::where('user_id', '=', auth()->user()->id)
                                ->where('product_id', '=', $product->id)
                                ->get();

        $cartItem[0]->delete();

        return response('success', 200);
    }
}
