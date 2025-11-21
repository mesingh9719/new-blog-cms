<x-layouts.app :title="$post->title"
    :metaDescription="$post->meta_description"
    :metaKeywords="$post->meta_keywords">

    <article class="max-w-3xl mx-auto">

        {{-- Back link --}}
        <a href="{{ url('/') }}" 
           class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Home
        </a>

        {{-- Title --}}
        <h1 class="text-4xl md:text-5xl font-bold article-font leading-tight mb-6">
            {{ $post->title }}
        </h1>

        {{-- Meta --}}
        <div class="flex items-center gap-4 text-gray-500 text-sm mb-12">

            {{-- Author Avatar --}}
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-semibold">
                <a href="{{ route('author.show', $post->author->id) }}"
                    class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                        {{ strtoupper(substr($post->author->name ?? 'U', 0, 1)) }}
                </a>
            </div>

            <div>
                <p class="text-gray-700 font-medium">
                    {{ $post->author->name ?? 'Unknown Author' }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ $post->published_at?->format('M d, Y') }} 
                    • {{ $post->reading_time ?? rand(3,8) }} min read
                </p>
            </div>
        </div>

        {{-- Featured Image --}}
        @if($post->featured_image)
            <div class="mb-12">
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}"
                     class="w-full rounded-xl border border-gray-200">
            </div>
        @endif

        {{-- Content --}}
        <div class="prose prose-lg max-w-none text-gray-800">
            {!! $post->content !!}
        </div>

        {{-- Categories --}}
        @if($post->categories->isNotEmpty())
            <div class="mt-12 flex flex-wrap gap-3">
                @foreach($post->categories as $category)
                    <a href="{{ url('/category/' . $category->slug) }}"
                       class="px-3 py-1 text-sm bg-gray-100 border border-gray-200 rounded-full text-gray-700 hover:bg-gray-200 transition">
                       #{{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Divider --}}
        <hr class="my-12 border-gray-200">

        {{-- More Posts --}}
        @if($related->isNotEmpty())
            <h3 class="text-2xl font-bold mb-6">Related Posts</h3>

            <div class="space-y-6">
                @foreach($related as $item)
                    <a href="{{ url('/post/' . $item->slug) }}" 
                       class="block group border border-gray-200 rounded-xl p-5 hover:border-gray-300 transition">

                        <h4 class="text-lg font-semibold article-font group-hover:text-blue-600 transition">
                            {{ $item->title }}
                        </h4>

                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">
                            {{ $item->excerpt }}
                        </p>

                    </a>
                @endforeach
            </div>
        @endif

    </article>

    {{-- Bottom Spacing --}}
    <div class="mt-16"></div>

</x-layouts.app>
