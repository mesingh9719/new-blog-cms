<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->latest()
            ->paginate(10);

        $trending = Post::published()
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $categories = Category::limit(15)->get();

        return view('posts.index', compact('posts', 'trending', 'categories'));
    }

    public function show(Post $post){
        $post->increment('views');

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($q) use ($post) {
                $q->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->limit(3)
            ->get();

        return view('posts.show', compact('post', 'related'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Prevent empty query
        if (!$query) {
            return redirect()->back();
        }

        $posts = Post::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                ->orWhere('excerpt', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['q' => $query]);

        $trending = Post::published()
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        $categories = Category::limit(15)->get();

        return view('search.index', compact('posts', 'query', 'trending', 'categories'));
    }

}
