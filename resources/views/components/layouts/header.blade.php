 <header
     class="border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md">
     @php
         // Helper to mark active nav links; accepts patterns like 'posts*' or '/'
         $activeClass = function ($pattern) {
             return request()->is($pattern)
                 ? 'text-blue-600 dark:text-blue-400 font-semibold'
                 : 'text-gray-700 dark:text-gray-200';
         };
     @endphp

     <div class="max-w-7xl mx-auto px-5 py-3">
         <div class="flex items-center justify-between gap-4">

             {{-- Logo --}}
             <a href="{{ url('/') }}" class="flex items-center gap-2">
                 @if (setting()->logo_url)
                     <img src="{{ setting()->logo_url }}" class="h-8 w-auto object-contain dark:hidden"
                         alt="{{ setting('site_name') }}">

                     <img src="{{ setting()->logo_dark_url }}" class="h-8 w-auto object-contain hidden dark:block"
                         alt="{{ setting('site_name') }}">
                 @else
                     <span
                         class="text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                         {{ setting('site_name', config('app.name')) }}
                     </span>
                 @endif
             </a>


             {{-- Left / Center Nav --}}
             <nav class="hidden md:flex items-center gap-8 text-sm">
                 <a href="{{ url('/') }}"
                     class="nav-link {{ $activeClass('/') }} hover:text-blue-600 dark:hover:text-blue-400">Home</a>
                 <a href="{{ url('/categories') }}"
                     class="nav-link {{ $activeClass('categories*') }} hover:text-blue-600 dark:hover:text-blue-400">Categories</a>
                 <a href="{{ url('/posts') }}"
                     class="nav-link {{ $activeClass('posts*') }} hover:text-blue-600 dark:hover:text-blue-400">Posts</a>
                    @foreach($pages as $page)
                     <a href="{{ route('page.show',$page->slug) }}"
                         class="nav-link {{ $activeClass('pages/' . $page->slug) }} hover:text-blue-600 dark:hover:text-blue-400">
                         {{ $page->title }}
                     </a>
                 @endforeach
             </nav>

             {{-- Right controls --}}
             <div class="flex items-center gap-3">

                 {{-- Inline search (desktop) --}}
                 <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center">
                     <label for="q" class="sr-only">Search</label>
                     <input id="q" name="q" value="{{ request('q') }}" type="search"
                         placeholder="Search articles..."
                         class="px-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-700 text-sm bg-white dark:bg-gray-800 focus:ring-1 focus:ring-blue-500 outline-none" />
                 </form>

                 {{-- Search icon (mobile) --}}
                 <a href="{{ route('search') }}"
                     class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors md:hidden"
                     aria-label="Search">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                     </svg>
                 </a>

                 <a href="{{ route('rss.index') }}"
                     class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                     aria-label="RSS Feeds">
                     <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                         <path
                             d="M4 4a16 16 0 0116 16h-3A13 13 0 004 7V4zm0 6a10 10 0 0110 10h-3A7 7 0 004 13v-3zm0 6a4 4 0 014 4H4v-4z" />
                     </svg>
                 </a>


                 {{-- Dark mode toggle --}}
                 <button id="themeToggle"
                     class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                     aria-label="Toggle dark mode">
                     <svg id="moonIcon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M20.354 15.354A9 9 0 018.646 3.646 9 9 0 1020.354 15.354z" />
                     </svg>
                     <svg id="sunIcon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M12 2v1m0 18v1m8.66-12.66l-.7.7M4.04 19.96l-.7.7M21 12h1M3 12H2m16.66 6.66l-.7-.7M6.34 6.34l-.7-.7M12 6a6 6 0 100 12 6 6 0 000-12z" />
                     </svg>
                 </button>

                 {{-- Mobile menu button --}}
                 <button id="mobileMenuBtn"
                     class="p-2 rounded-lg md:hidden hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                     aria-label="Toggle menu">
                     <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M4 6h16M4 12h16M4 18h16" />
                     </svg>
                     <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M6 18L18 6M6 6l12 12" />
                     </svg>
                 </button>

             </div>
         </div>
     </div>

     {{-- Mobile nav (hidden by default) --}}
     <div id="mobileMenu"
         class="hidden md:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
         <nav class="px-5 py-4 space-y-1">
             <a href="{{ url('/') }}"
                 class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Home</a>
             <a href="{{ url('/categories') }}"
                 class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Categories</a>
             <a href="{{ url('/posts') }}"
                 class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Posts</a>

             <a href="{{ route('search') }}"
                 class="block px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Search</a>
         </nav>
     </div>
 </header>
