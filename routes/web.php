<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class,"welcome"]);

Route::get('/author/{user:id}', [AuthorController::class, 'show'])
    ->name('author.show');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])
    ->name('category.show');

Route::get('/tag/{tag:slug}', [TagController::class, 'show'])
    ->name('tag.show');


Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/feeds', [RssController::class, 'index'])->name('rss.index');
Route::get('/feed', [RssController::class, 'posts'])->name('rss.feed');
Route::get('/feed/categories', [RssController::class, 'categoriesList'])->name('rss.categories');
Route::get('/feed/category/{slug}', [RssController::class, 'category'])->name('rss.category');

Route::get('/feed/tags', [RssController::class, 'tagsList'])->name('rss.tags');
Route::get('/feed/tag/{slug}', [RssController::class, 'tag'])->name('rss.tag');

    

