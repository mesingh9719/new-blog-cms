<section class="text-center py-16">
    <h2 class="text-4xl font-bold mb-4">
        {{ $data['title'] }}
    </h2>

    @if(!empty($data['button_text']))
        <a href="{{ $data['button_url'] }}"
           class="px-6 py-3 bg-blue-600 text-white rounded-lg">
            {{ $data['button_text'] }}
        </a>
    @endif
</section>
