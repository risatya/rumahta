	<!-- list view untuk menampilkan daftar listing -->
	<ul data-role="listview" style="margin:0px;">
	<?php $counter = 0; ?>
	<?php foreach($list_listing as $item): ?>
	
		<li>
			<a href="<?php echo base_url(); ?>index.php/page/listing_detail/<?php echo $item->id_listing_member; ?>">
				<?php if($cover_listing[$counter] != null){ ?>
					<?php echo "<img src='http://rumahta.com/file/img/".($item->status_listing == 1 ? "premium" : "free")."/thumb/".$cover_listing[$counter]."' />"; ?>
				<?php } else { ?>
					<?php echo "<img src='http://rumahta.com/file/img/".($item->status_listing == 1 ? "premium" : "free")."/thumb/default.jpg' />"; ?>
				<?php } ?> 
				<h4 class="judul_listing"><?php echo strtoupper($item->nama_kategori)."<br/>".($item->laku == 1 ? "(".($item->status_kategori == 1 ? "<b>TERJUAL</b>" : "<b>TERSEWA</b>").") " : "").$item->judul; ?></h4>
				<p>Rp. <?php echo $item->harga; ?> | <?php echo $item->nama_kabupaten; ?></p>
			</a>
		</li>
	
	<?php $counter++; ?>
	<?php endforeach; ?>
	</ul>
	
	<!--pagination-->
	<center>
	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	</center>