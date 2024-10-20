<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\UpdateRequest;
use App\Models\Cart;
use App\Models\Product;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product, UpdateRequest $request)
    {
        $data = $request->validated();

        $cartItem = Cart::where('user_id', '=', auth()->user()->id)
                        ->where('product_id', '=', $product->id)
                        ->get();

        $cartItem[0]->update($data);

        return response('success', 200);
    }
}
