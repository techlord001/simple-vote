<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $request->validate([
            'vote_number' => 'required|integer',
            'estimated_location' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->vote) {
            return response()->json([
                'message' => 'You have already voted',
            ], 403);
        }

        $vote = $user->vote()->create([
            'vote_number' => $request->vote_number,
            'ip_address' => $request->ip(),
            'estimated_location' => $request->estimated_location,
        ]);

        return response()->json($vote, 201);
    }
}
