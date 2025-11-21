<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
<channel>

    <title>All Tags — <?php echo config('app.name'); ?></title>
    <link><?php echo url('/'); ?></link>
    <description>List of all tags</description>

    <?php foreach ($tags as $tag): ?>
        <item>
            <title><![CDATA[ <?php echo $tag->name; ?> ]]></title>
            <link><?php echo route('rss.tag', $tag->slug); ?></link>
            <guid><?php echo route('rss.tag', $tag->slug); ?></guid>
            <description><![CDATA[ RSS feed for tag <?php echo $tag->name; ?> ]]></description>
        </item>
    <?php endforeach; ?>

</channel>
</rss>
