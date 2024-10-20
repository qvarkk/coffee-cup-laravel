<?php

namespace App\Http\Controllers\Favorited;

use App\Http\Controllers\Controller;
use App\Models\Favorited;
use Illuminate\Http\Request;

class UsersItemsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $favorites = Favorited::where('user_id', auth()->user()->id)->get();
        $products_ids = $favorites->pluck('product_id');
        return response([
            'data' => [
                'products' => $products_ids
            ],
        ], 200);
    }
}
