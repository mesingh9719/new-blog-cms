<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
<channel>

    <title>All Categories — <?php echo config('app.name'); ?></title>
    <link><?php echo url('/'); ?></link>
    <description>List of all categories</description>

    <?php foreach ($categories as $category): ?>
        <item>
            <title><![CDATA[ <?php echo $category->name; ?> ]]></title>
            <link><?php echo route('rss.category', $category->slug); ?></link>
            <guid><?php echo route('rss.category', $category->slug); ?></guid>
            <description><![CDATA[ RSS feed for category <?php echo $category->name; ?> ]]></description>
        </item>
    <?php endforeach; ?>

</channel>
</rss>
