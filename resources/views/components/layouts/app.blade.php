@props([
    'title',
    'metaDescription',
    'metaKeywords' => '',
    'category' => null,
    'tag' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Dynamic Title --}}
    <title>{{ ($title ?? '') ? $title . ' — ' : '' }}{{ setting('site_name', config('app.name')) }}</title>

    {{-- SEO Meta --}}
    <meta name="description" content="{{ $metaDescription ?? config('app.name') }}" />
    <meta name="keywords" content="{{ $metaKeywords }}" />
    <meta name="author" content="{{ setting('site_name', config('app.name')) }}" />

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title ?? config('app.name') }}" />
    <meta property="og:description" content="{{ $metaDescription ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('banner.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="alternate" type="application/rss+xml" title="Posts RSS" href="{{ route('rss.feed') }}">
    <link rel="alternate" type="application/rss+xml" title="Categories RSS" href="{{ route('rss.categories') }}">
    <link rel="alternate" type="application/rss+xml" title="Tags RSS" href="{{ route('rss.tags') }}">


    {{-- Favicon --}}
    <link rel="icon" href="{{ setting()->favicon_url }}">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Inline Styles --}}
    <style>
        body { font-family: 'Inter', sans-serif; }
        .article-font { font-family: 'Playfair Display', serif; }

        * { transition: background-color .22s, color .22s, border-color .22s; }

        .fade-in { opacity: 0; animation: fadeIn .32s ease forwards; }
        @keyframes fadeIn { to { opacity: 1; } }

        #progressBar {
            position: fixed; top:0; left:0; height:3px;
            background:#2563eb; width:0; z-index:60;
        }

        .nav-link { position: relative; }
        .nav-link::after {
            content:''; position:absolute; bottom:-4px; left:0;
            width:0; height:2px; background:currentColor;
            transition: width .28s;
        }
        .nav-link:hover::after { width:100%; }

        ::-webkit-scrollbar { width:8px; height:8px; }
        ::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:4px; }
        .dark ::-webkit-scrollbar-thumb { background:#475569; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Dark-mode pre-init --}}
    <script>
        (() => {
            try {
                if (localStorage.theme === 'dark' ||
                    (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            } catch(_) {}
        })();
    </script>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    {{-- Progress bar --}}
    <div id="progressBar"></div>

    {{-- HEADER --}}
    <x-layouts.header />

    {{-- MAIN CONTENT --}}
    <main class="max-w-7xl mx-auto px-5 py-10 min-h-screen fade-in">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <x-layouts.footer />

    {{-- JS --}}
    <script>
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        mobileBtn?.addEventListener('click', e => {
            e.stopPropagation();
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        document.addEventListener('click', e => {
            if (!mobileBtn || !mobileMenu) return;
            if (!mobileMenu.contains(e.target) && !mobileBtn.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        const themeToggle = document.getElementById('themeToggle');
        themeToggle?.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
        });

        const progress = document.getElementById('progressBar');
        function updateProgress() {
            const s = window.scrollY;
            const h = document.documentElement.scrollHeight - window.innerHeight;
            progress.style.width = `${(s / h) * 100}%`;
        }
        window.addEventListener('scroll', updateProgress, { passive: true });
        window.addEventListener('resize', updateProgress);
        window.addEventListener('load', updateProgress);
    </script>

</body>
</html>
