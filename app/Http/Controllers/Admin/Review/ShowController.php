<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ReviewResource;
use App\Models\Review;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Review $review)
    {
        return new ReviewResource($review);
    }
}
