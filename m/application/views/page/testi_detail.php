	<!-- halaman untuk menampilkan listing detail -->
	<?php foreach($testi_detail as $item ):?>

		<div data-role="content" class="container ui-content" role="main">	
		
			<h3><?php echo "Testimoni ".$item->nama." (".$item->username.")"; ?></h3>

			<p>
				submitted on : <?php echo date('d-M-Y',strtotime($item->tanggal)); ?>  <br/><br/>
				<img src="http://rumahta.com/file/img/pp/<?php echo ($item->user_photo != null ? $item->user_photo : "default_pp.jpg"); ?>" />
				
				<?php echo html_entity_decode($item->testimoni); ?>
			</p>
			
		</div>
	
	<?php endforeach; ?>