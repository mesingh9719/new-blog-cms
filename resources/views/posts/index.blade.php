<x-layouts.app title="All Posts">

    {{-- Page Title --}}
    <section class="mx-auto mb-12">
        <h1 class="text-4xl font-bold article-font mb-3">
            All Posts
        </h1>

        <p class="text-gray-600 text-lg">
            Explore all articles published on the platform.
        </p>
    </section>

    <div class="grid lg:grid-cols-3 gap-12">

        {{-- Posts List --}}
        <section class="lg:col-span-2 space-y-8">

            @foreach($posts as $post)
                <article class="group rounded-xl overflow-hidden border border-gray-200 bg-white shadow-sm">
                    
                    <div class="grid md:grid-cols-3">
                        
                        {{-- Image --}}
                        @if($post->featured_image)
                            <div class="h-40 md:h-full overflow-hidden">
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition">
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="p-6 md:col-span-2">

                            @if($post->categories->isNotEmpty())
                                <div class="flex gap-2 mb-2">
                                    @foreach($post->categories->take(2) as $cat)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">
                                            {{ $cat->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ url('/post/' . $post->slug) }}">
                                <h2 class="text-xl font-semibold article-font group-hover:text-blue-600 transition line-clamp-2">
                                    {{ $post->title }}
                                </h2>
                            </a>

                            <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                                {{ $post->excerpt }}
                            </p>

                            <div class="flex justify-between text-xs text-gray-500 mt-4">
                                <a href="{{ route('author.show', $post->author->id) }}"
                                    class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                                        <span>{{ $post->author->name ?? 'Unknown' }}</span>
                                </a>
                               
                                <span>{{ $post->published_at?->format('M d, Y') }}</span>
                            </div>
                        </div>

                    </div>

                </article>
            @endforeach

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $posts->links() }}
            </div>

        </section>

        {{-- Sidebar --}}
        <aside class="space-y-10">

            {{-- Trending --}}
            <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-sm">
                <h3 class="text-xl font-bold mb-4">Trending Now</h3>

                @foreach($trending as $i => $trend)
                    <a href="{{ url('/post/' . $trend->slug) }}" class="flex gap-3 mb-5 group">

                        <span class="text-gray-300 text-2xl font-bold group-hover:text-blue-600 transition">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div>
                            <p class="font-semibold text-sm line-clamp-2 group-hover:text-blue-600 transition">
                                {{ $trend->title }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $trend->published_at?->format('M d') }}
                            </p>
                        </div>

                    </a>
                @endforeach
            </div>

            {{-- Categories --}}
            <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-sm">
                <h3 class="text-xl font-bold mb-4">Categories</h3>

                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $cat)
                        <a href="{{ url('/category/' . $cat->slug) }}"
                           class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

        </aside>

    </div>

    <div class="mt-16"></div>

</x-layouts.app>
