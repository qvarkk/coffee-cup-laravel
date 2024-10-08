<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Review $review)
    {
        $review->delete();

        return response()->json(['message' => 'success']);
    }
}
