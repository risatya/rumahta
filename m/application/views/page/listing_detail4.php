	<!-- halaman untuk menampilkan listing detail -->
	<?php foreach($listing as $item ):?>

		<div data-role="content" class="container ui-content" role="main">	
		
			<h3><?php echo $item->judul; ?></h3>
			
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=155508457882678";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="https://www.facebook.com/rumahtacom" data-send="false" data-width="450" data-show-faces="false"></div>
			
			<p class="alert_listing" align="justify" style="line-height:17px;"><small><b>HATI-HATI! </b> terhadap penipuan, jangan lakukan transaksi sebelum melihat surat-surat lengkap, melihat properti yang diminati dan yakin. Sebaiknya gunakan jasa notaris agar lebih aman dalam bertransaksi. Rumahta.com tidak bertanggung jawab dengan isi / iklan yang terpasang.</small></p>

			<?php foreach($listing_cover as $cover): ?>
				<?php $photoname = $cover->listing_photo_thumb; $x++; ?>
			<?php endforeach; ?>
			<?php if($x == 0){$photoname = "default.jpg"; } ?>
			<?php if($item->status_paket == 1){ ?>
					<img src="http://rumahta.com/file/img/free/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" />
			<?php } else {?>
					<img src="http://rumahta.com/file/img/premium/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" />
			<?php } ?>

			<p class="listing_detail">
				<i class="icon icon-check"></i><span class="spanstyle">KATEGORI : </span><?php echo $item->nama_kategori; ?> <br/>
				<i class="icon icon-check"></i><span class="spanstyle">HARGA : </span><?php echo "Rp. ".$item->harga; ?> <br/>
				<i class="icon icon-check"></i><span class="spanstyle">KAB / KOTA : </span><?php echo ucfirst(strtolower($item->nama_kabupaten)); ?> <br/>
				<i class="icon icon-check"></i><span class="spanstyle">KONDISI : </span><?php echo $item->kondisi; ?> <br/>
				<i class="icon icon-check"></i><span class="spanstyle">ALAMAT : </span><?php echo $item->alamat; ?> <br/>
			</p>
		</div>
		
		<div data-role="content" class="container ui-content map_content" role="main">
			
			<hr/>
			
			<?php echo $item->keterangan ; ?>
			
			<hr/>
			
			<?php
				foreach($data_user as $user):
				$userphoto = ($user->user_photo == null ? "default_pp.jpg" : $user->user_photo);
				$userlogo = ($user->company_photo == null ? "default_logo.jpg" : $user->company_photo);
			?>
			<h3><strong>Hubungi Pengiklan / Agen</strong></h3><br/>
			<div data-role="content" class="container ui-content" role="main">
					<img src="http://rumahta.com/file/img/pp/<?php echo $userphoto; ?>" align="left" class="img-polaroid" width="70px" style="margin-right:10px;" />
					<p style="margin-top : 0px;">
					Nama : <?php echo ($user->nama == null ? "-" : $user->nama); ?><br/>
					HP/Telp : <?php echo ($user->hp == null ? "-" : $user->hp)." / ".($user->telepon == null ? "-" : $user->telepon);?><br/>
					Alamat : <?php echo ($user->alamat == null ? "-" : $user->alamat); ?>
					</p>
				<br/>
					<img src="http://rumahta.com/file/img/company/<?php echo $userlogo; ?>" align="left" class="img-polaroid" width="70px" style="margin-right:10px;" />
					<p>
					Nama Perusahaan: <br/> <?php echo ($user->company_name == "" ? "-" : $user->company_name); ?>
					</p>
			</div><!-- /grid-a -->

			<?php endforeach; ?>
			
			<hr/><br/><br/>
			
			<!--Data kode pos, sertifikat MLS dll.-->
			
			<div data-role="content" class="container ui-content" role="main">
					<i class="icon icon-check"></i> <span class="spanstyle">KODE POS : </span><?php echo $item->kodepos; ?> <br/>
					<i class="icon icon-check"></i> <span class="spanstyle">SERTIFIKAT : </span><?php echo $item->sertifikat; ?> <br/>
					<i class="icon icon-check"></i> <span class="spanstyle">MLS : </span><?php echo $item->mls; ?> <br/>
			</div><!-- /grid-a -->
			
			<hr/><br/><br/>
			
			<div data-role="content" class="container ui-content" role="main">
					<img src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png" width="15px" style="margin-top:-5px;"/> <span class="spanstyle">JUMLAH LANTAI : </span> <?php echo ($item->jml_lantai == 0 || $item->jml_lantai == null ? "-" : $item->jml_lantai); ?> <br/>
					<img src="<?php echo base_url(); ?>file/img/icon_luas.png" width="20px" style="margin-top:-5px;"/> <span class="spanstyle">LUAS BANGUNAN : </span> <?php echo ($item->luas_bangunan == 0 || $item->luas_bangunan == null ? "-" : $item->luas_bangunan); ?> M<sup>2</sup><br/>
					<img src="<?php echo base_url(); ?>file/img/icon_garden.png" width="20px" style="margin-top:-5px;"/> <span class="spanstyle">LUAS TANAH : </span> <?php echo ($item->luas_tanah == 0 || $item->luas_tanah == null ? "-" : $item->luas_tanah); ?> M<sup>2</sup><br/>				
			</div><!-- /grid-a -->
			
			<hr/>

		</div>
		
		<!--attach file css-->
		<link rel="stylesheet" href="http://rumahta.com/file/css/gallerystyle.css" type="text/css" />
		<link rel="stylesheet" href="http://rumahta.com/file/css/elastislide.css" type="text/css" />
		
		<!--attach file js-->
		<script src="http://rumahta.com/file/js/jquery.tmpl.min.js" type="text/javascript"></script>
		<script src="http://rumahta.com/file/js/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="http://rumahta.com/file/js/jquery.elastislide.js" type="text/javascript"></script>
		<script src="http://rumahta.com/file/js/gallery.js" type="text/javascript"></script>
		
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
		
		<div data-role="content" class="container ui-content map_content" role="main">
			<br/>

			<?php if($listing_photo != null){ ?>
			<div id="rg-gallery" class="rg-gallery">
				<div class="rg-thumbs">
					<div class="es-carousel-wrapper" style="margin:0px 0 10px 0">
						<div class="es-nav">
							<span class="es-nav-prev">Previous</span>
							<span class="es-nav-next">Next</span>
						</div>
						<div class="es-carousel">
							<ul>
							<?php foreach($listing_photo as $cover): ?>
							<?php if($item->status_paket == 1){ ?>
									<li><a href="#"><img src="http://rumahta.com/file/img/free/thumb/<?php echo $cover->listing_photo_thumb; ?>" data-large="http://rumahta.com/file/img/free/<?php echo $cover->listing_photo_big;?>" /></a></li>
							<?php } else {?>
									<li><a href="#"><img src="http://rumahta.com/file/img/premium/thumb/<?php echo $cover->listing_photo_thumb; ?>" data-large="http://rumahta.com/file/img/premium/<?php echo $cover->listing_photo_big;?>" /></a></li>
							<?php } ?>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php }else{ ?>
			Tidak ada foto.
			<?php } ?>
		</div>
	
	<?php endforeach; ?>