	<!-- halaman untuk menampilkan listing detail -->
	<?php foreach($news_detail as $item ):?>

		<div data-role="content" class="container ui-content" role="main">	
		
			<h3><?php echo $item->title; ?></h3>

			<p>
				posted on : <?php echo date('d-M-Y',strtotime($item->tanggal)); ?> <br/><br/>
				<?php if($item->photo != null){ ?>
					<img src="http://rumahta.com/file/img/news/<?php echo $item->photo; ?>" align="left" style="margin:0 10px 10px 0;" />
				<?php } ?>
				
				<?php echo html_entity_decode($item->isi); ?>
			</p>
			
		</div>
	
	<?php endforeach; ?>