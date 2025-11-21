<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<rss version="2.0">
<channel>

    <title>Test Feed — Dung</title>
    <link><?php echo url('/'); ?></link>
    <description>Testing RSS without Blade</description>
    <language>en</language>
    <lastBuildDate><?php echo now()->toRssString(); ?></lastBuildDate>

    <item>
        <title><![CDATA[ Test Item ]]></title>
        <link><?php echo url('/test-item'); ?></link>
        <guid><?php echo url('/test-item'); ?></guid>
        <description><![CDATA[ This is only a test. ]]></description>
    </item>

</channel>
</rss>
