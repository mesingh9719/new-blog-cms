<x-layouts.app title="RSS Feeds" metaDescription="Subscribe to our RSS feeds">

    <section class="max-w-4xl mx-auto">

        {{-- Page Title --}}
        <h1 class="text-4xl font-bold article-font mb-6">RSS Feeds</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-10 leading-relaxed">
            Subscribe to our feeds using any RSS reader (Feedly, Inoreader, NewsBlur, etc).
            Click the copy button to quickly copy any RSS link.
        </p>

        {{-- Helper Component --}}
        @php
            function rssRow($label, $url) {
                return "
                <div class='rss-row'>
                    <span class='flex-1'>$label</span>
                    <a href='$url' class='rss-url' target='_blank'>$url</a>
                    <button class='copy-btn' data-copy='$url'>Copy</button>
                </div>";
            }
        @endphp


        {{-- Main Feeds --}}
        <h2 class="section-title">Main Feeds</h2>
        <div class="space-y-3">
            {!! rssRow('🔥 All Posts Feed', route('rss.feed')) !!}
            {!! rssRow('📚 Categories Feed Index', route('rss.categories')) !!}
            {!! rssRow('🏷️ Tags Feed Index', route('rss.tags')) !!}
        </div>


        {{-- Category Feeds --}}
        <h2 class="section-title mt-12">Category Specific Feeds</h2>
        <div class="space-y-3">
            @foreach($categories as $cat)
                {!! rssRow("📘 {$cat->name}", route('rss.category', $cat->slug)) !!}
            @endforeach
        </div>


        {{-- Tag Feeds --}}
        <h2 class="section-title mt-12">Tag Specific Feeds</h2>
        <div class="space-y-3">
            @foreach($tags as $tag)
                {!! rssRow("🏷️ {$tag->name}", route('rss.tag', $tag->slug)) !!}
            @endforeach
        </div>

    </section>

    {{-- Styles --}}
    <style>
        .rss-row {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 12px 16px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
        }
        .dark .rss-row {
            background: #111827;
            border-color: #374151;
        }

        .rss-url {
            flex-shrink: 0;
            color: #2563eb;
            font-weight: 500;
            word-break: break-all;
        }
        .copy-btn {
            padding: 6px 12px;
            border: 1px solid #2563eb;
            color: #2563eb;
            border-radius: 6px;
            background: white;
            cursor: pointer;
            transition: 0.2s;
            font-size: 13px;
        }
        .dark .copy-btn {
            background: #1f2937;
            border-color: #3b82f6;
            color: #3b82f6;
        }
        .copy-btn:hover {
            background: #2563eb;
            color: white;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
        }
    </style>

    {{-- Copy Script --}}
    <script>
        document.querySelectorAll('.copy-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const text = btn.dataset.copy;

                navigator.clipboard.writeText(text).then(() => {
                    btn.textContent = "Copied!";
                    btn.style.backgroundColor = "#16a34a";
                    btn.style.color = "white";

                    setTimeout(() => {
                        btn.textContent = "Copy";
                        btn.style.backgroundColor = "";
                        btn.style.color = "";
                    }, 1600);
                });
            });
        });
    </script>

</x-layouts.app>
