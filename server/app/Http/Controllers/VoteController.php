<?php

namespace App\Http\Controllers;

use App\Jobs\StoreVote;
use App\Models\User;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $request->validate([
            'vote_number' => 'required|integer',
            'estimated_location' => 'required|string', // Remove this line during deployment
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->vote) {
            return response()->json([
                'message' => 'You have already voted',
            ], 403);
        }

        // Include for localhost testing
        if ($request->ip() == 'http://localhost' || $request->ip() == 'http://127.0.0.1') {
            $location = 'localhost';
        }

        // Add this during deployment
        // $location = Location::get($request->ip()); // Call $location->countryName to get the country name

        StoreVote::dispatch($user, $request->vote_number, $request->ip(), $location);

        return response()->json(['message' => 'Your vote has been cast!'], 201);
    }
}
