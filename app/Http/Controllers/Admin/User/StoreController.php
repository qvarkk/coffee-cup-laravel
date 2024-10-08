<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return new UserResource($user);
    }
}
