<footer class="border-t border-gray-200 dark:border-gray-800 py-12 bg-gray-50 dark:bg-gray-900/50">
    <div class="max-w-7xl mx-auto px-5">
        <div class="grid md:grid-cols-4 gap-8 mb-8">

            {{-- Branding --}}
            <div class="md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-3">
                    @if(setting()->logo_url)
                        <img src="{{ setting()->logo_url }}"
                             alt="{{ setting('site_name') }}"
                             class="h-8 w-auto object-contain dark:hidden">

                        <img src="{{ setting()->logo_dark_url }}"
                             alt="{{ setting('site_name') }}"
                             class="h-8 w-auto object-contain hidden dark:block">
                    @else
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                            {{ setting('site_name', config('app.name')) }}
                        </span>
                    @endif
                </a>

                @if(setting('site_tagline'))
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ setting('site_tagline') }}
                    </p>
                @else
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        A modern News & Blog CMS focused on readability and editorial UX.
                    </p>
                @endif
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-semibold mb-3 text-gray-900 dark:text-gray-100">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li><a href="/about" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">About</a></li>
                    <li><a href="/contact" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a></li>
                    <li><a href="/privacy" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Privacy</a></li>
                    <li><a href="/terms" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Terms</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="font-semibold mb-3 text-gray-900 dark:text-gray-100">Newsletter</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                    Get the best stories delivered to your inbox.
                </p>
                <form action="#" method="POST" class="flex gap-2">
                    <input type="email" name="email" placeholder="Your email"
                           class="flex-1 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 
                           focus:ring-2 focus:ring-blue-500 outline-none text-sm" />
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 
                            text-white rounded-lg text-sm">
                        Join
                    </button>
                </form>
            </div>

            {{-- RSS Feeds --}}
            <div>
                <h4 class="font-semibold mb-3 text-gray-900 dark:text-gray-100">RSS Feeds</h4>

                <div class="flex items-center gap-3">
                    <a href="{{ route('rss.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                              hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-sm font-medium">

                        <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 19a2 2 0 11-4 0 2 2 0 014 0zm-4-8v3a1 1 0 001 1c4.411 0 8 3.589 8 8a1 1 0 001 1h3a1 1 0 001-1c0-6.065-4.935-11-11-11a1 1 0 00-1 1zm0-6v3a1 1 0 001 1c8.271 0 15 6.729 15 15a1 1 0 001 1h3a1 1 0 001-1C23 10.85 13.15 1 1 1a1 1 0 00-1 1z"/>
                        </svg>

                        <span>RSS Hub</span>
                    </a>
                </div>

                <div class="flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('rss.feed') }}"
                       class="px-3 py-1.5 text-xs font-medium rounded-full bg-orange-100 dark:bg-orange-900/40 
                              text-orange-700 dark:text-orange-300 hover:bg-orange-200 dark:hover:bg-orange-900 
                              transition-colors">
                        All Posts RSS
                    </a>

                    <a href="{{ route('rss.categories') }}"
                       class="px-3 py-1.5 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/40 
                              text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900 
                              transition-colors">
                        Categories RSS
                    </a>

                    <a href="{{ route('rss.tags') }}"
                       class="px-3 py-1.5 text-xs font-medium rounded-full bg-purple-100 dark:bg-purple-900/40 
                              text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-900 
                              transition-colors">
                        Tags RSS
                    </a>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600 dark:text-gray-400">

            <p>&copy; {{ date('Y') }} {{ setting('site_name', config('app.name')) }}. All rights reserved.</p>

            {{-- Social Links --}}
            <div class="flex items-center gap-6">
                @php $social = setting('social_links', []); @endphp

                @if($social)
                    @foreach($social as $platform => $url)
                        @if($url)
                            <a href="{{ $url }}" target="_blank"
                               class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
                               aria-label="{{ $platform }}">
                                <i class="fa-brands fa-{{ $platform }} text-lg"></i>
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</footer>
