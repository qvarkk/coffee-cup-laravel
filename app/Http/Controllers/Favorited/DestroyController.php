<?php

namespace App\Http\Controllers\Favorited;

use App\Http\Controllers\Controller;
use App\Models\Favorited;
use App\Models\Product;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $favorited = Favorited::where('user_id', '=', auth()->user()->id)
                                ->where('product_id', '=', $product->id)
                                ->get();

        $favorited[0]->delete();

        return response('success', 200);
    }
}
