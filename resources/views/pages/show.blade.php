<x-layouts.page-layout :title="$page->seo_title" :metaDescription="$page->seo_description">

    <article class="prose dark:prose-invert max-w-4xl mx-auto">
        <h1>{{ $page->title }}</h1>
        @if ($page->blocks->count())
            @foreach ($page->blocks as $block)
                @includeIf('blocks.' . $block->type, ['data' => $block->data])
            @endforeach
        @else
            {{-- fallback for old content --}}
            {!! $page->content !!}
        @endif

    </article>

</x-layouts.page-layout>
