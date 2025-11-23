<section class="py-24 text-center bg-cover bg-center text-white"
         style="background-image: url('{{ asset('storage/'.$data['background']) ?? '' }}')">
    <h1 class="text-5xl font-bold mb-6">{{ $data['title'] }}</h1>

    @if(!empty($data['subtitle']))
        <p class="text-xl mb-6">{{ $data['subtitle'] }}</p>
    @endif

    @if(!empty($data['button_text']))
        <a href="{{ $data['button_url'] }}"
           class="px-6 py-3 bg-white text-black rounded-lg font-semibold">
            {{ $data['button_text'] }}
        </a>
    @endif
</section>
