<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, UpdateRequest $request)
    {
        $data = $request->validated();

        $category->update($data);

        return new CategoryResource($category->fresh());
    }
}
