<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::with('blocks')
            ->where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        return view('pages.show', compact('page'));
    }

}
