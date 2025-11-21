<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class SitemapController extends Controller
{
    private function xml($view, $data = [])
    {
        $xml = view($view, $data)->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml')
            ->header('X-Content-Type-Options', 'nosniff');
    }

    public function index()
    {
        $sitemaps = [
            url('/sitemap/posts.xml'),
            url('/sitemap/categories.xml'),
            url('/sitemap/tags.xml'),
        ];

        return $this->xml('sitemap.index', compact('sitemaps'));
    }

    public function posts()
    {
        $posts = Post::whereNotNull('published_at')->latest()->get();
        return $this->xml('sitemap.posts', compact('posts'));
    }

    public function categories()
    {
        $categories = Category::all();
        return $this->xml('sitemap.categories', compact('categories'));
    }

    public function tags()
    {
        $tags = Tag::all();
        return $this->xml('sitemap.tags', compact('tags'));
    }
}
