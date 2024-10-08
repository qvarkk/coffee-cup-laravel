<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Review\StoreRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Resources\Admin\ReviewResource;
use App\Models\Product;
use App\Models\Review;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $review = Review::create($data);

        return new ReviewResource($review);
    }
}
