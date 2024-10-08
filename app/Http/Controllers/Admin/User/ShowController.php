<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        return new UserResource($user);
    }
}
