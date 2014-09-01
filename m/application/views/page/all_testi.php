	<!-- list view untuk menampilkan daftar listing -->
	
	<h3>Testimoni Member</h3>
	
	<ul data-role="listview" style="margin:0px;">

	<?php foreach($all_testi as $item ): ?>
	
		<li>
			<a href="<?php echo base_url(); ?>index.php/page/testi_detail/<?php echo $item->id_testimoni; ?>">
				<img src="http://rumahta.com/file/img/pp/<?php echo ($item->user_photo != null ? $item->user_photo : "default_pp.jpg"); ?>"/>
				<h4 class="judul_listing ui-li-heading2"><?php echo $item->nama." (".$item->username.")"; ?></h4>
				<p style="margin-left : 0px;"><?php echo substr(str_replace(array("<p>","</p>","<br>","<br/>","<div>","</div>"),"",html_entity_decode($item->testimoni)),0,220); ?></p>
			</a>
		</li>
	
	<?php endforeach; ?>
	</ul>
	
	<!--pagination-->
	<center>
	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	</center>