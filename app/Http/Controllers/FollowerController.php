<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(Request $request, $userId)
    {
        $follower = $request->user();

        if ($follower->id === (int) $userId) {
            return response()->json(['error' => 'You cannot follow yourself.'], 403);
        }

        $follower->following()->toggle($userId);

        return response()->json([
            'following' => $follower->following()->where('user_id', $userId)->exists(),
            'followers_count' => User::find($userId)->followers()->count()
        ]);
    }
}
