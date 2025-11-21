<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>

    <title><?php echo config('app.name'); ?> — Latest Posts</title>
    <link><?php echo url('/'); ?></link>
    <description>Latest published posts</description>
    <atom:link href="<?php echo route('rss.feed'); ?>" rel="self" type="application/rss+xml" />
    <lastBuildDate><?php echo now()->toRssString(); ?></lastBuildDate>

    <?php foreach ($posts as $post): ?>
        <item>
            <title><![CDATA[ <?php echo $post->title; ?> ]]></title>
            <link><?php echo route('post.show', $post->slug); ?></link>
            <guid isPermaLink="true"><?php echo route('post.show', $post->slug); ?></guid>
            <description><![CDATA[ <?php echo $post->excerpt; ?> ]]></description>
            <pubDate><?php echo optional($post->published_at)->toRssString(); ?></pubDate>

            <?php if ($post->featured_image): ?>
                <enclosure url="<?php echo asset('storage/' . $post->featured_image); ?>" type="image/jpeg" />
            <?php endif; ?>

        </item>
    <?php endforeach; ?>

</channel>
</rss>
