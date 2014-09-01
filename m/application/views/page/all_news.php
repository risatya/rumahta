	<!-- list view untuk menampilkan daftar listing -->
	
	<h3>Berita</h3>
	
	<ul data-role="listview" style="margin:0px;">

	<?php foreach($all_news as $item ): ?>
	
		<li>
			<a href="<?php echo base_url(); ?>index.php/page/news_detail/<?php echo $item->id_artikel; ?>">
				<?php if($item->photo != null){ ?>
					<img src="http://rumahta.com/file/img/news/thumb/<?php echo $item->photo_thumb; ?>" />
				<?php }else{ ?>
					<img src="http://rumahta.com/file/img/news/thumb/default_news.jpg" />
				<?php } ?>
				<h4 class="judul_listing ui-li-heading2"><?php echo $item->title; ?></h4>
				<p style="margin-left : 0px;"><?php echo substr(str_replace(array("<p>","</p>","<br>","<br/>","<div>","</div>"),"",html_entity_decode($item->isi)),0,220); ?></p>
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