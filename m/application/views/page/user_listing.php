	<!-- halaman untuk menampilkan listing detail -->
	
	<?php 
	foreach($user as $item): 
		$userphoto = ($item->user_photo == null ? "default_pp.jpg" : $item->user_photo);
		$userlogo = ($item->company_photo == null ? "default_logo.jpg" : $item->company_photo);
	?>
		
	<h3><?php echo $item->nama; ?></h3><br/>
	
	<div data-role="content" class="container ui-content" role="main">	
		
		<div class="ui-grid-a" style="font-size:12px;">
			<div class="ui-block-a">
				<img src="http://rumahta.com/file/img/pp/<?php echo $userphoto; ?>" align="left" class="img-polaroid" width="70px" style="margin-right:10px;" />
				<p style="margin-top : 0px;">
				HP/Telp : <?php echo ($item->hp == null ? "-" : $item->hp)." / ".($item->telepon == null ? "-" : $item->telepon);?><br/>
				Alamat : <?php echo ($item->alamat == null ? "-" : $item->alamat); ?>
				</p>
			</div>
			<div class="ui-block-b">
				<img src="<?php echo base_url(); ?>file/img/company/<?php echo $userlogo; ?>" align="left" class="img-polaroid" width="70px" style="margin-right:10px;" />
				<p>
				Nama Perusahaan: <br/> <?php echo ($item->company_name == "" ? "-" : $item->company_name); ?>
				</p>
			</div>
		</div><!-- /grid-a -->
		
	</div>
	
	<br/>
	
	<?php  endforeach; ?>
	
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