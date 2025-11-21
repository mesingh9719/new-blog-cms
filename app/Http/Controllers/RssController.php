<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class RssController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::select('name','slug')->get();
        $tags = \App\Models\Tag::select('name','slug')->get();

        return view('feed.index', compact('categories', 'tags'));
    }


    private function xml($view, $data = [])
    {
        $xml = view($view, $data)->render();
        return response($xml, 200)->header('Content-Type', 'application/rss+xml');
    }

    public function posts()
    {
        $posts = Post::published()->latest()->take(50)->get();
        return $this->xml('feed.posts', compact('posts'));
    }

    // 3️⃣ Single Category Feed
    // ---------------------------
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->published()->latest()->take(50)->get();

        return $this->xml('feed.category', compact('category', 'posts'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->published()->latest()->take(50)->get();

        return $this->xml('feed.tag', compact('tag', 'posts'));
    }


    public function categoriesList()
    {
        $categories = Category::orderBy('name')->get();
        return $this->xml('feed.categories-list', compact('categories'));
    }

    public function tagsList()
    {
        $tags = Tag::orderBy('name')->get();
        return $this->xml('feed.tags-list', compact('tags'));
    }


}
