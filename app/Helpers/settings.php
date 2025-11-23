<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        $settings = Cache::remember('settings', 3600, fn() => Setting::first()?->fresh());

        if (! $settings) {
            return $default;
        }

        if ($key === null) {
            return $settings;
        }

        return $settings->{$key} ?? $default;
    }
}
