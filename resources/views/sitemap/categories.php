<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($categories as $cat): ?>
    <url>
        <loc><?= url('/category/' . $cat->slug) ?></loc>
        <lastmod><?= optional($cat->updated_at)->toAtomString() ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
<?php endforeach; ?>
</urlset>
