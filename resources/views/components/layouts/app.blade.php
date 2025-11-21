<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Dynamic Title --}}
    <title>{{ ($title ?? '') ? $title . ' — ' : '' }}{{ config('app.name') }}</title>

    {{-- SEO Meta --}}
    <meta name="description" content="{{ $metaDescription ?? config('app.name') }}" />
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}" />
    <meta name="author" content="{{ config('app.name') }}" />

    {{-- Open Graph / Social --}}
    <meta property="og:title" content="{{ $title ?? config('app.name') }}" />
    <meta property="og:description" content="{{ $metaDescription ?? '' }}" />
    <meta property="og:type" content="website" />
    {{-- Local file path for banner (will be transformed to a URL by your deployment/tooling) --}}
    <meta property="og:image" content="{{ '/mnt/data/A_banner_graphic_for_a_Laravel_News_CMS_utilizes_a.png' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />

    {{-- Favicon (add a real favicon file at public/favicon.png) --}}
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .article-font { font-family: 'Playfair Display', serif; }

        /* Smooth transitions for theme changes */
        * { transition: background-color 0.22s ease, color 0.22s ease, border-color 0.22s ease; }

        /* Fade-in for main content */
        .fade-in { opacity: 0; animation: fadeIn .32s ease-in-out forwards; }
        @keyframes fadeIn { to { opacity: 1; } }

        /* Reading progress bar */
        #progressBar { position: fixed; top: 0; left: 0; height: 3px; background-color: #2563eb; width: 0; z-index: 60; transition: width 0.15s linear; }

        /* Custom scrollbar (subtle) */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }

        /* Nav underline hover */
        .nav-link { position: relative; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: currentColor;
            transition: width 0.28s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* Utility to visually hide elements but keep accessible */
        .sr-only { position: absolute !important; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); border: 0; white-space: nowrap; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Prevent flash-of-unstyled-theme --}}
    <script>
        (function() {
            try {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) { /* ignore */ }
        })();
    </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    {{-- Reading progress bar --}}
    <div id="progressBar" aria-hidden="true"></div>

    {{-- NAVBAR --}}
    <header class="border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md">
        @php
            // Helper to mark active nav links; accepts patterns like 'posts*' or '/'
            $activeClass = function($pattern) {
                return request()->is($pattern) ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-700 dark:text-gray-200';
            };
        @endphp

        <div class="max-w-7xl mx-auto px-5 py-3">
            <div class="flex items-center justify-between gap-4">

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                    {{ config('app.name') }}
                </a>

                {{-- Left / Center Nav --}}
                <nav class="hidden md:flex items-center gap-8 text-sm">
                    <a href="{{ url('/') }}" class="nav-link {{ $activeClass('/') }} hover:text-blue-600 dark:hover:text-blue-400">Home</a>
                    <a href="{{ url('/categories') }}" class="nav-link {{ $activeClass('categories*') }} hover:text-blue-600 dark:hover:text-blue-400">Categories</a>
                    <a href="{{ url('/posts') }}" class="nav-link {{ $activeClass('posts*') }} hover:text-blue-600 dark:hover:text-blue-400">Posts</a>
                    <a href="{{ url('/tags') }}" class="nav-link {{ $activeClass('tags*') }} hover:text-blue-600 dark:hover:text-blue-400">Tags</a>
                </nav>

                {{-- Right controls --}}
                <div class="flex items-center gap-3">

                    {{-- Inline search (desktop) --}}
                    <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center">
                        <label for="q" class="sr-only">Search</label>
                        <input id="q" name="q" value="{{ request('q') }}" type="search" placeholder="Search articles..."
                            class="px-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-700 text-sm bg-white dark:bg-gray-800 focus:ring-1 focus:ring-blue-500 outline-none" />
                    </form>

                    {{-- Search icon (mobile) --}}
                    <a href="{{ route('search') }}" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors md:hidden" aria-label="Search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </a>

                    {{-- Dark mode toggle --}}
                    <button id="themeToggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle dark mode">
                        <svg id="moonIcon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9 9 0 1020.354 15.354z"/>
                        </svg>
                        <svg id="sunIcon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v1m0 18v1m8.66-12.66l-.7.7M4.04 19.96l-.7.7M21 12h1M3 12H2m16.66 6.66l-.7-.7M6.34 6.34l-.7-.7M12 6a6 6 0 100 12 6 6 0 000-12z"/>
                        </svg>
                    </button>

                    {{-- Mobile menu button --}}
                    <button id="mobileMenuBtn" class="p-2 rounded-lg md:hidden hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle menu">
                        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                </div>
            </div>
        </div>

        {{-- Mobile nav (hidden by default) --}}
        <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
            <nav class="px-5 py-4 space-y-1">
                <a href="{{ url('/') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Home</a>
                <a href="{{ url('/categories') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Categories</a>
                <a href="{{ url('/posts') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Posts</a>
                <a href="{{ url('/tags') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Tags</a>
                <a href="{{ route('search') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Search</a>
            </nav>
        </div>
    </header>

    {{-- MAIN: fade-in and constrained width --}}
    <main class="max-w-7xl mx-auto px-5 py-10 min-h-screen fade-in">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="border-t border-gray-200 dark:border-gray-800 py-12 bg-gray-50 dark:bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <h3 class="text-xl font-bold mb-3 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                        {{ config('app.name') }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ config('app.name') }} is a modern News & Blog CMS focused on readability and editorial UX.
                    </p>
                </div>

                <div>
                    <h4 class="font-semibold mb-3 text-gray-900 dark:text-gray-100">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="/about" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">About</a></li>
                        <li><a href="/contact" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a></li>
                        <li><a href="/privacy" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Privacy</a></li>
                        <li><a href="/terms" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Terms</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-3 text-gray-900 dark:text-gray-100">Newsletter</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Get the best stories delivered to your inbox.</p>
                    <form action="#" method="POST" class="flex gap-2">
                        <input type="email" name="email" placeholder="Your email" class="flex-1 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 outline-none text-sm" />
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white rounded-lg text-sm">Join</button>
                    </form>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    {{-- social icons (placeholders) --}}
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors" aria-label="twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775..."/></svg>
                    </a>
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors" aria-label="facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642..."/></svg>
                    </a>
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors" aria-label="instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584..."/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }

        // Close mobile menu clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenuBtn || !mobileMenu) return;
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Dark mode toggle
        const themeToggle = document.getElementById('themeToggle');
        themeToggle?.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        // Update sun/moon icons (in case of manual initial state)
        function refreshThemeIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            document.getElementById('sunIcon').classList.toggle('hidden', !isDark);
            document.getElementById('moonIcon').classList.toggle('hidden', isDark);
        }
        refreshThemeIcons();

        // Reading progress indicator
        const progressBar = document.getElementById('progressBar');
        function updateProgressBar() {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const docHeight = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight) - window.innerHeight;
            const percent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            progressBar.style.width = Math.min(100, percent) + '%';
        }
        document.addEventListener('scroll', updateProgressBar, { passive: true });
        window.addEventListener('resize', updateProgressBar);

        // Fade-in class is applied via CSS animation already; ensure it runs on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.fade-in').forEach(el => el.style.opacity = '');
            updateProgressBar();
        });
    </script>

</body>
</html>
