	<!-- halaman untuk menampilkan listing detail -->
	<?php foreach($page_content as $item ):?>

		<div data-role="content" class="container ui-content" role="main">	
		
			<h3><?php echo $item->title; ?></h3>

			<p>
				<?php echo html_entity_decode($item->content); ?>
			</p>
			
		</div>
	
	<?php endforeach; ?>