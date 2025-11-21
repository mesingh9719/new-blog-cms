<x-layouts.app title="Categories">

    {{-- Page Header --}}
    <section class="mx-auto mb-12">
        <h1 class="text-4xl font-bold article-font mb-3">
            Browse Categories
        </h1>

        <p class="text-lg text-gray-600 dark:text-gray-400">
            Explore all topics available in the publication.
        </p>
    </section>

    {{-- Categories Grid --}}
    <section class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($categories as $cat)
            <a href="{{ url('/category/' . $cat->slug) }}"
               class="group p-5 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">

                {{-- Image --}}
                @if($cat->image)
                    <div class="h-32 mb-4 overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $cat->image) }}"
                             alt="{{ $cat->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition">
                    </div>
                @else
                    <div class="h-32 mb-4 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </div>
                @endif

                {{-- Name --}}
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                    {{ $cat->name }}
                </h2>

                {{-- Count --}}
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    {{ $cat->posts_count }} {{ Str::plural('post', $cat->posts_count) }}
                </p>

            </a>
        @endforeach

    </section>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $categories->links() }}
    </div>

    <div class="mt-16"></div>

</x-layouts.app>
