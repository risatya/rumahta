<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
	<channel>
		<title><?php echo $feed_name; ?></title>
		<link><?php echo $feed_url; ?></link>
		<description><?php echo $page_description; ?></description>
		<dc:language><?php echo $page_language; ?></dc:language>
		<dc:creator><?php echo $creator_email; ?></dc:creator>

		<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
		<admin:generatorAgent rdf:resource="http://www.rumahta.com/" />

		<?php foreach($posts as $row):?>
			http://rumahta.com/page/listing_detail/155/Kios-Disewakan-Oper-Kontrak-Kios
			<item>
				<title><?php echo $row->judul; ?></title>
				<link><?php echo site_url("page/listing_detail/".$row->id_listing); ?></link>
				<guid><?php echo site_url("page/listing_detail/".$row->id_listing); ?></guid>

				<description>
					<![CDATA[
						<?=str_replace('/assets/uploads/', base_url() . 'assets/uploads/', $row->keterangan); ?>
					]]>
				</description>

			</item>

		<?php endforeach; ?>

	</channel>
</rss>