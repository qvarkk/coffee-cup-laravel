<?php

namespace App\Http\Controllers\Favorited;

use App\Http\Controllers\Controller;
use App\Models\Favorited;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        Favorited::create([
            'product_id' => $product->id,
            'user_id' => auth()->id()
        ]);

        return response('success', 200);
    }
}
