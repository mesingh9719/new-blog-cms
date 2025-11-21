<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $posts = Post::published()->latest()->paginate(10);
        $trending = Post::published()->orderBy('views', 'desc')->limit(5)->get();

        return view('welcome', compact('posts', 'trending'));
    }

}
