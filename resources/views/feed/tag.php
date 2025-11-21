<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
<channel>

    <title><?php echo $tag->name; ?> — Tag Feed</title>
    <link><?php echo route('tag.show', $tag->slug); ?></link>
    <description>Posts under tag: <?php echo $tag->name; ?></description>

    <?php foreach ($posts as $post): ?>
        <item>
            <title><![CDATA[ <?php echo $post->title; ?> ]]></title>
            <link><?php echo route('post.show', $post->slug); ?></link>
            <guid><?php echo route('post.show', $post->slug); ?></guid>
            <description><![CDATA[ <?php echo $post->excerpt; ?> ]]></description>
            <pubDate><?php echo optional($post->published_at)->toRssString(); ?></pubDate>
        </item>
    <?php endforeach; ?>

</channel>
</rss>
