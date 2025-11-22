<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo',
        'logo_dark',
        'favicon',
        'meta_title',
        'meta_description',
        'social_links',
        'posts_per_page',
        'rss_enabled',
    ];

    protected $casts = [
        'social_links' => 'array',
        'rss_enabled' => 'boolean',
    ];

    protected $appends = [
        'logo_url',
        'logo_dark_url',
        'favicon_url',
    ];

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('settings'));
        static::deleted(fn () => Cache::forget('settings'));
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? Storage::url($this->logo)
            : null;
    }

    public function getLogoDarkUrlAttribute()
    {
        return $this->logo_dark
            ? Storage::url($this->logo_dark)
            : $this->logo_url;
    }

    public function getFaviconUrlAttribute()
    {
        return $this->favicon
            ? Storage::url($this->favicon)
            : asset('favicon.png');
    }
}
