<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show(Request $request, User $user)
    {

        return view('profile.show', [
            'user' => $user,
            'posts' => $user->posts()->latest()->paginate()
        ]);
    }
}
