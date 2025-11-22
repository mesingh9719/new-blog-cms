<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    // Auto-create slug if missing
    protected static function booted()
    {
        static::saving(function ($page) {
            if (! $page->slug) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    // SEO title fallback
    public function getSeoTitleAttribute()
    {
        return $this->meta_title ?: $this->title;
    }

    public function getSeoDescriptionAttribute()
    {
        return $this->meta_description ?: Str::limit(strip_tags($this->content), 160);
    }
}
