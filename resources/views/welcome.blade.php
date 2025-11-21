<x-layouts.app>
      {{-- Hero --}}
        <section class="mb-12">
            <h1 class="text-5xl font-bold tracking-tight article-font mb-3">
                Latest Stories
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl">
                Curated news, insights, and stories from around the world.
            </p>
        </section>

        {{-- Featured Post --}}
        @if($posts->isNotEmpty())
            @php $featured = $posts->first(); @endphp

            <section class="mb-16">
                <article class="group rounded-xl overflow-hidden border border-gray-200 bg-white shadow-sm">

                    <div class="grid md:grid-cols-2">

                        {{-- Image --}}
                        @if($featured->featured_image)
                            <div class="h-64 md:h-full overflow-hidden">
                                <img src="{{ asset('storage/' . $featured->featured_image) }}"
                                    alt="{{ $featured->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="p-8 flex flex-col justify-center">

                            {{-- Category --}}
                            @if($featured->categories->isNotEmpty())
                                <span class="inline-block mb-3 px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded">
                                    {{ $featured->categories->first()->name }}
                                </span>
                            @endif

                            {{-- Title --}}
                            <a href="/post/{{ $featured->slug }}">
                                <h2 class="text-3xl font-bold article-font leading-tight group-hover:text-blue-600 transition">
                                    {{ $featured->title }}
                                </h2>
                            </a>

                            {{-- Excerpt --}}
                            <p class="text-gray-600 mt-4">
                                {{ Str::limit($featured->excerpt, 160) }}
                            </p>

                            {{-- Author --}}
                            <div class="flex items-center gap-3 mt-6">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr($featured->author->name ?? 'U', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-medium">{{ $featured->author->name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $featured->published_at?->format('M d, Y') }} · {{ rand(3,7) }} min read
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </article>
            </section>
        @endif

        {{-- Content + Sidebar --}}
        <div class="grid lg:grid-cols-3 gap-12">

            {{-- Recent Posts --}}
            <section class="lg:col-span-2 space-y-8">

                <h3 class="text-2xl font-bold mb-4">Recent Posts</h3>

                @foreach($posts->skip(1)->take(6) as $post)
                    <article class="group rounded-xl overflow-hidden border border-gray-200 bg-white shadow-sm">

                        <div class="grid md:grid-cols-3">

                            {{-- Image --}}
                            @if($post->featured_image)
                                <div class="h-40 md:h-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition" />
                                </div>
                            @endif

                            {{-- Content --}}
                            <div class="p-6 md:col-span-2">

                                {{-- Categories --}}
                                @if($post->categories->isNotEmpty())
                                    <div class="flex gap-2 mb-2">
                                        @foreach($post->categories->take(2) as $cat)
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">
                                                {{ $cat->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Title --}}
                                <a href="/post/{{ $post->slug }}">
                                    <h4 class="text-xl font-semibold article-font group-hover:text-blue-600 transition line-clamp-2">
                                        {{ $post->title }}
                                    </h4>
                                </a>

                                {{-- Excerpt --}}
                                <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                                    {{ $post->excerpt }}
                                </p>

                                {{-- Author + Date --}}
                                <div class="flex justify-between text-xs text-gray-500 mt-4">
                                    <span>{{ $post->author->name ?? 'Unknown' }}</span>
                                    <span>{{ $post->published_at?->diffForHumans() }}</span>
                                </div>

                            </div>

                        </div>

                    </article>
                @endforeach

            </section>

            {{-- Sidebar --}}
            <aside class="space-y-10">

                {{-- Trending --}}
                <div class="border border-gray-200 rounded-xl p-6 bg-white shadow-sm">
                    <h3 class="text-xl font-bold mb-4">Trending Now</h3>

                    @foreach($trending as $i => $trend)
                        <a href="/post/{{ $trend->slug }}" class="flex gap-3 mb-5 group">
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
                    <h3 class="text-xl font-bold mb-4">Popular Topics</h3>

                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTopics ?? [] as $topic)
                            <a href="/categories/{{ $topic->slug }}"
                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition">
                                {{ $topic->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

            </aside>

        </div>
</x-layouts.app>