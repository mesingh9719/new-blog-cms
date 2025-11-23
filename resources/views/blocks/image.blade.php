<figure class="my-8">
    <img src="{{ $data['url'] }}" class="rounded-lg mx-auto" />

    @if(!empty($data['caption']))
        <figcaption class="text-center text-sm text-gray-500 mt-2">
            {{ $data['caption'] }}
        </figcaption>
    @endif
</figure>
