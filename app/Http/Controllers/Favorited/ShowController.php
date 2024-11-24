<?php

namespace App\Http\Controllers\Favorited;

use App\Http\Controllers\Controller;
use App\Models\Favorited;
use App\Models\Product;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $favorites = Favorited::where('user_id', auth()->user()->id)
                                ->where('product_id', $product->id)
                                ->get();

        return response([
            'data' => [
                'products' => $favorites
            ],
        ], 200);
    }
}
