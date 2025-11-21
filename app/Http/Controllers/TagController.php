<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        // Posts with this tag
        $posts = $tag->posts()
            ->published()
            ->latest()
            ->paginate(10);

        // Trending (sidebar)
        $trending = Post::published()
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        // Categories for sidebar (optional)
        $categories = Category::limit(15)->get();

        return view('tags.show', compact('tag', 'posts', 'trending', 'categories'));
    }
}
