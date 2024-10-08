<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'success']);
    }
}
