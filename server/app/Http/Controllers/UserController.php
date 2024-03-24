<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::create([
            'email' => $request->email,
        ]);

        return response()->json($user, 201);
    }
}
