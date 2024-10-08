<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Resources\Admin\UserResource;
use App\Models\Product;
use App\Models\User;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, UpdateRequest $request)
    {
        $data = $request->validated();

        $user->update($data);

        return new UserResource($user->fresh());
    }
}
