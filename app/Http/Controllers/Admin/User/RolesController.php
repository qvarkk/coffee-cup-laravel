<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class RolesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return response([
            'data' => [
                [
                    'id' => User::ROLE_USER,
                    'name' => User::getRoles()[User::ROLE_USER],
                ],
                [
                    'id' => User::ROLE_ADMIN,
                    'name' => User::getRoles()[User::ROLE_ADMIN],
                ]
            ]
        ]);
    }
}
