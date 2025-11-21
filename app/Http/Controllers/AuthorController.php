<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()
            ->published()
            ->latest()
            ->paginate(10);

        $postCount = $user->posts()->published()->count();

        return view('author.show', compact('user', 'posts', 'postCount'));
    }
}
