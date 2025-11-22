<x-app-layout
    :title="$page->seo_title"
    :metaDescription="$page->seo_description">

    <article class="prose dark:prose-invert max-w-4xl mx-auto">
        <h1>{{ $page->title }}</h1>
        {!! $page->content !!}
    </article>

</x-app-layout>
