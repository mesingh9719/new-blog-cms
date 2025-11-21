<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($posts as $post): ?>
    <url>
        <loc><?= route('post.show', $post->slug) ?></loc>
        <lastmod><?= optional($post->updated_at)->toAtomString() ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>
</urlset>
