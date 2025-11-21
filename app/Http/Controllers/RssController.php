<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function jsonFeed()
    {
        $posts = Post::with(['author', 'categories', 'tags'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        $feed = [
            'version' => 'https://jsonfeed.org/version/1.1',
            'title' => config('app.name') . ' — Latest Posts',
            'home_page_url' => url('/'),
            'feed_url' => url('/feed.json'),
            'description' => 'Latest published posts',
            'items' => $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'url' => route('post.show', $post->slug),
                    'title' => $post->title,
                    'content_html' => $post->content, // HTML content
                    'summary' => $post->excerpt ?? Str::limit(strip_tags($post->content), 160),
                    'image' => $post->featured_image_url ?? null,
                    'date_published' => optional($post->published_at)->toRfc3339String(),
                    'authors' => [
                        [
                            'name' => $post->author->name ?? null,
                            'url' => route('author.show', $post->author->id),
                            'avatar' => $post->author->avatar_url ?? null,
                        ]
                    ],
                    'tags' => $post->tags->pluck('name')->toArray(),
                ];
            })
        ];

        return response()->json($feed);
    }


    public function jsonFeedCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->with(['author', 'categories', 'tags'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        $feed = [
            'version' => 'https://jsonfeed.org/version/1.1',
            'title' => $category->name . ' — Category Feed',
            'home_page_url' => url('/category/' . $category->slug),
            'feed_url' => url("/feed/category/{$category->slug}.json"),
            'description' => "Latest posts in {$category->name}",
            'items' => $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'url' => route('post.show', $post->slug),
                    'title' => $post->title,
                    'content_html' => $post->content,
                    'summary' => $post->excerpt ?? Str::limit(strip_tags($post->content), 160),
                    'image' => $post->featured_image_url,
                    'date_published' => optional($post->published_at)->toRfc3339String(),
                    'authors' => [
                        [
                            'name' => $post->author->name,
                            'url' => route('author.show', $post->author->id),
                            'avatar' => $post->author->avatar_url,
                        ]
                    ],
                    'tags' => $post->tags->pluck('name')->toArray(),
                ];
            })
        ];

        return response()->json($feed);
    }

    public function jsonFeedTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->with(['author', 'categories', 'tags'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        $feed = [
            'version' => 'https://jsonfeed.org/version/1.1',
            'title' => $tag->name . ' — Tag Feed',
            'home_page_url' => url('/tag/' . $tag->slug),
            'feed_url' => url("/feed/tag/{$tag->slug}.json"),
            'description' => "Latest posts tagged with {$tag->name}",
            'items' => $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'url' => route('post.show', $post->slug),
                    'title' => $post->title,
                    'content_html' => $post->content,
                    'summary' => $post->excerpt ?? Str::limit(strip_tags($post->content), 160),
                    'image' => $post->featured_image_url,
                    'date_published' => optional($post->published_at)->toRfc3339String(),
                    'authors' => [
                        [
                            'name' => $post->author->name,
                            'url' => route('author.show', $post->author->id),
                            'avatar' => $post->author->avatar_url,
                        ]
                    ],
                    'tags' => $post->tags->pluck('name')->toArray(),
                ];
            })
        ];

        return response()->json($feed);
    }



}
