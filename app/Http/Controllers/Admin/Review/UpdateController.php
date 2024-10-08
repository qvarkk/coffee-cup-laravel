<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Review\UpdateRequest;
use App\Http\Resources\Admin\ReviewResource;
use App\Models\Review;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Review $review, UpdateRequest $request)
    {
        $data = $request->validated();

        $review->update($data);

        return new ReviewResource($review->fresh());
    }
}
