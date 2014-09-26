
					<div id="main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
				
						<?php foreach($listing as $item ):?>
						<fieldset>
							<legend><?php echo $item->judul; ?></legend>
							
							<!--attach file css-->
							<link rel="stylesheet" href="<?php echo base_url();?>file/css/gallerystyle.css" type="text/css" />
							<link rel="stylesheet" href="<?php echo base_url();?>file/css/elastislide.css" type="text/css" />
							
							<!--attach file js-->
							<script src="<?php echo base_url(); ?>file/js/jquery.tmpl.min.js" type="text/javascript"></script>
							<script src="<?php echo base_url(); ?>file/js/jquery.easing.1.3.js" type="text/javascript"></script>
							<script src="<?php echo base_url(); ?>file/js/jquery.elastislide.js" type="text/javascript"></script>
							<script src="<?php echo base_url(); ?>file/js/gallery.js" type="text/javascript"></script>
							
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
							
							<div class="page-header" id="page-header" style="margin:10px 0 10px 0;">
								<h2><small>Foto</small></h2>
							</div>
							<div id="detail_wrapper">
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
														<li><a href="#"><img src="<?php echo base_url(); ?>file/img/free/thumb/<?php echo $cover->listing_photo_thumb; ?>" data-large="<?php echo base_url(); ?>file/img/free/<?php echo $cover->listing_photo_big;?>" /></a></li>
												<?php } else {?>
														<li><a href="#"><img src="<?php echo base_url(); ?>file/img/premium/thumb/<?php echo $cover->listing_photo_thumb; ?>" data-large="<?php echo base_url(); ?>file/img/premium/<?php echo $cover->listing_photo_big;?>" /></a></li>
												<?php } ?>
												<?php endforeach; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div style="float:left;margin:-10px 0 10px 0;">
								<script type="text/javascript">var switchTo5x=true;</script>
								<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">stLight.options({publisher: "4d898c07-8504-480d-aa05-6a835c626475"}); </script>
								<span class='st_fbrec_hcount' displayText='Facebook Share'></span>
								<span class='st_twitter_hcount' displayText='Tweet'></span>
								<span class='st_plusone_hcount' displayText='Google +1'></span>
							</div>
							
							<div class="alert alert-error" style="float:right;margin-bottom:10px;">
								<p align="justify" style="line-height:17px;"><small><b>HATI-HATI! </b> terhadap penipuan, jangan lakukan transaksi sebelum melihat surat-surat lengkap, melihat properti yang diminati dan yakin. Sebaiknya gunakan jasa notaris agar lebih aman dalam bertransaksi. Rumahta.com tidak bertanggung jawab dengan isi / iklan yang terpasang.</small></p>
							</div>

							<?php foreach($listing_cover as $cover): ?>
								<?php $photoname = $cover->listing_photo_thumb; $x++; ?>
							<?php endforeach; ?>
							<?php if($x == 0){$photoname = "default.jpg"; } ?>
							<?php if($item->status_paket == 1){ ?>
								<div class="photo_listing_wrapper">
									<img src="<?php echo base_url(); ?>file/img/free/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" style="margin-right : 10px;" />
									<?php if($item->laku == 1){ ?><span class="photo_marker"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
								</div>
							<?php } else {?>
								<div class="photo_listing_wrapper">
									<img src="<?php echo base_url(); ?>file/img/premium/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" style="margin-right : 10px;" />
									<?php if($item->laku == 1){ ?><span class="photo_marker"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
								</div>
							<?php } ?>

							<p class="listing_detail">
								<span>KATEGORI : </span><?php echo $item->nama_kategori; ?> <br/>
								<span>HARGA : </span><?php echo "Rp. ".$item->harga; ?> <br/>
								<span>KAB / KOTA : </span><?php echo ucfirst(strtolower($item->nama_kabupaten)); ?> <br/>
								<span>ALAMAT : </span><?php echo $item->alamat; ?> <br/>
								<span>KECAMATAN : </span><?php echo $item->kecamatan; ?> <br/>
								<span>KONDISI : </span><?php echo $item->kondisi; ?> <br/>
							</p>
							
							<?php
								foreach($data_user as $user):
								$userphoto = ($user->user_photo == null ? "default_pp.jpg" : $user->user_photo);
								$userlogo = ($user->company_photo == null ? "default_logo.jpg" : $user->company_photo);
							?>
								
							<div id="tentang_pengiklan">
								<h4><b>Hubungi Pengiklan / Agen</b></h4>
								<div style="width:60%;float:left;">
									<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $userphoto; ?>" align="left" class="img-polaroid" width="100px" style="margin-right:10px;" />
									<p>
									Nama : <?php echo ($user->nama == null ? "-" : $user->nama); ?><br/>
									No. Contact : <?php echo ($user->hp == null ? "-" : $user->hp)." / ".($user->telepon == null ? "-" : $user->telepon);?><br/>
									Alamat : <?php echo ($user->alamat == null ? "-" : $user->alamat); ?>
									</p>
								</div>
								<div style="width:40%;float:left">
									<img src="<?php echo base_url(); ?>file/img/company/<?php echo $userlogo; ?>" align="left" class="img-polaroid" width="100px" style="margin-right:10px;" />
									<p>
									Nama Perusahaan: <br/> <?php echo ($user->company_name == "" ? "-" : $user->company_name); ?>
									</p>
								</div>
							</div>
							<?php endforeach; ?>
							
							<div class="page-header" id="page-header">
								<h2><small>Detail / Deskripsi</small></h2>
							</div>
							<div id="detail_wrapper">
								<div style="width:100%;float:left;">
								
									<!-- Attach JS File -->
									<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
								
									<script type="text/javascript">
									var geocoder = new google.maps.Geocoder();

									function geocodePosition(pos) {
									  geocoder.geocode({
										latLng: pos
									  }, function(responses) {
										if (responses && responses.length > 0) {
										  updateMarkerAddress(responses[0].formatted_address);
										} else {
										  updateMarkerAddress('Cannot determine address at this location.');
										}
									  });
									}

									function updateMarkerStatus(str) {
									  document.getElementById('markerStatus').value = str;
									}

									function updateMarkerPosition(latLng) {
									  document.getElementById('info').value = [
										latLng.lat(),
										latLng.lng()
									  ].join(', ');
									  document.getElementById('latitude').value = latLng.lat();
									  document.getElementById('longitude').value = latLng.lng();
									}

									function updateMarkerAddress(str) {
									  document.getElementById('address').value = str;
									}

									function initialize() {
									  var latLng = new google.maps.LatLng(<?php echo $item->latitude.",".$item->longitude; ?>);
									  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
										zoom: <?php echo $item->zoom_level; ?>,
										center: latLng,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									  });
									  var marker = new google.maps.Marker({
										position: latLng,
										title: '<?php echo $item->judul; ?>',
										map: map,
										draggable: false,
										icon: new google.maps.MarkerImage(
											"<?php echo base_url();?>file/img/point2.png", // reference from your base
											new google.maps.Size(50, 40), // size of image to capture
											new google.maps.Point(0, 0), // start reference point on image (upper left)
											new google.maps.Point(13, 40), // point on image to center on latlng (scaled)
											new google.maps.Size(50, 40) // actual size on map
										)
									  });
									  
									  // Update current position info.
									  updateMarkerPosition(latLng);
									  geocodePosition(latLng);
									  
									  // Add dragging event listeners.
									  google.maps.event.addListener(marker, 'dragstart', function() {
										updateMarkerAddress('Dragging...');
									  });
									  
									  google.maps.event.addListener(marker, 'drag', function() {
										updateMarkerStatus('Dragging...');
										updateMarkerPosition(marker.getPosition());
									  });
									  
									  google.maps.event.addListener(marker, 'dragend', function() {
										updateMarkerStatus('Drag ended');
										geocodePosition(marker.getPosition());
									  });
									}

									// Onload handler to fire off the app.
									google.maps.event.addDomListener(window, 'load', initialize);
									</script>
									
									<?php if($item->show_map == 1){ ?>
										<div id="mapCanvas" class="thumbnail"></div>
									<?php } ?>
									
									<?php echo $item->keterangan ; ?>
								</div>
								
								<div class="page-header" id="page-header">
									<h2><small></small></h2>
								</div>
								
								<div style="width:50%;float:left;margin-right:20px;">
									<i class="icon icon-check"></i> <span>KODE POS : </span><?php echo $item->kodepos; ?> <br/>
									<i class="icon icon-check"></i> <span>SERTIFIKAT : </span><?php echo $item->sertifikat; ?> <br/>
								</div>
								<div style="width:45%;float:left">
									<i class="icon icon-check"></i> <span>MLS : </span><?php echo $item->mls; ?> <br/>
								</div>
							</div>
							<div class="page-header" id="page-header">
								<h2><small></small></h2>
							</div>
							<div id="detail_wrapper">
								<div style="width:50%;float:left;margin-right:20px;">
									<img src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png" width="15px" style="margin-top:-5px;"/> <span>JUMLAH LANTAI : </span> <?php echo ($item->jml_lantai == 0 || $item->jml_lantai == null ? "-" : $item->jml_lantai); ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_luas.png" width="20px" style="margin-top:-5px;"/> <span>LUAS BANGUNAN : </span> <?php echo ($item->luas_bangunan == 0 || $item->luas_bangunan == null ? "-" : $item->luas_bangunan); ?> M<sup>2</sup><br/>
								</div>
								<div style="width:45%;float:left">
									<img src="<?php echo base_url(); ?>file/img/icon_garden.png" width="20px" style="margin-top:-5px;"/> <span>LUAS TANAH : </span> <?php echo ($item->luas_tanah == 0 || $item->luas_tanah == null ? "-" : $item->luas_tanah); ?> M<sup>2</sup><br/>
								</div>
							</div>
							
						</fieldset>
						<?php endforeach; ?>