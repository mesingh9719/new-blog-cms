<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')
            ->orderBy('name')
            ->paginate(20);

        return view('categories.index', compact('categories'));
    }
    
    public function show(Category $category)
    {
        // Load posts in this category
        $posts = $category->posts()
            ->published()
            ->latest()
            ->paginate(10);

        // Trending sidebar
        $trending = Post::published()
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        // Popular tags (optional)
        $tags = Tag::limit(15)->get();

        return view('categories.show', compact('category', 'posts', 'trending', 'tags'));
    }
}
