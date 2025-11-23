<section class="grid md:grid-cols-2 gap-8 items-center my-12">
    @if(empty($data['reverse']))
        <img src="{{ $data['image'] }}" class="rounded-lg" />
        <div class="prose dark:prose-invert">{!! $data['text'] !!}</div>
    @else
        <div class="prose dark:prose-invert">{!! $data['text'] !!}</div>
        <img src="{{ $data['image'] }}" class="rounded-lg" />
    @endif
</section>
