<x-layouts.app :title="$user->name" :metaDescription="$user->name . ' — Author Profile'">

    {{-- Header --}}
    <section class="mb-12 max-w-4xl mx-auto">

        <div class="flex items-center gap-6">
            
            {{-- Avatar --}}
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>
                <h1 class="text-4xl font-bold article-font">{{ $user->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ $user->email }}
                </p>
            </div>

        </div>

        {{-- Stats --}}
        <div class="flex items-center gap-6 mt-6 text-gray-600 dark:text-gray-400">
            <span>{{ $postCount }} {{ Str::plural('Post', $postCount) }}</span>
            <span>Joined {{ $user->created_at->format('F Y') }}</span>
        </div>

    </section>

    {{-- Posts List --}}
    <section class="max-w-4xl mx-auto space-y-8">

        <h2 class="text-2xl font-bold mb-4">Posts by {{ $user->name }}</h2>

        @forelse($posts as $post)
            <article class="group border border-gray-200 dark:border-gray-800 rounded-xl p-6 bg-white dark:bg-gray-900 shadow-sm hover:shadow-md transition">

                <a href="{{ url('/post/' . $post->slug) }}">
                    <h3 class="text-xl font-semibold article-font group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                        {{ $post->title }}
                    </h3>
                </a>

                <p class="text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">
                    {{ $post->excerpt }}
                </p>

                <div class="flex justify-between text-sm text-gray-500 dark:text-gray-500 mt-4">
                    <span>{{ $post->published_at?->format('M d, Y') }}</span>
                    <span>{{ rand(3, 7) }} min read</span>
                </div>

            </article>
        @empty
            <p class="text-gray-500">No posts published yet.</p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $posts->links() }}
        </div>

    </section>

</x-layouts.app>
