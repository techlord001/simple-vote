<?php

namespace App\Http\Controllers;

use App\Jobs\StoreVote;
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

        StoreVote::dispatch($user, $request->vote_number, $request->ip(), $request->estimated_location);

        return response()->json(['message' => 'Your vote has been cast!'], 201);
    }
}
