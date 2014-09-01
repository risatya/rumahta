
					<div id="main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<?php foreach($listing as $item ):?>
						<fieldset style="width:670px">
							<legend><?php echo $item->judul; ?></legend>
							
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
								<span>KONDISI : </span><?php echo $item->kondisi; ?> <br/>
							</p>
							
							<?php
								foreach($data_user as $user):
								$userphoto = ($user->user_photo == null ? "default_pp.jpg" : $user->user_photo);
								$userlogo = ($user->company_photo == null ? "default_logo.jpg" : $user->company_photo);
							?>
								
							<div id="tentang_pengiklan">
								<h3><b>Tentang Pengiklan / Agen</b></h3>
								<div style="width:71%;float:left;">
									<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $userphoto; ?>" align="left" class="img-polaroid" width="50px" style="margin-right:10px;" />
									<p>
									Nama : <?php echo ($user->nama == null ? "-" : $user->nama); ?><br/>
									No. Contact : <?php echo ($user->hp == null ? "-" : $user->hp)." / ".($user->telepon == null ? "-" : $user->telepon);?><br/>
									Alamat : <?php echo ($user->alamat == null ? "-" : $user->alamat); ?>
									</p>
								</div>
								<div style="width:29%;float:left">
									<img src="<?php echo base_url(); ?>file/img/company/<?php echo $userlogo; ?>" align="left" class="img-polaroid" width="50px" style="margin-right:10px;" />
									<p>
									Nama Perusahaan: <br/> <?php echo ($user->company_name == "" ? "-" : $user->company_name); ?>
									</p>
								</div>
							</div>
							<?php endforeach; ?>
							
							<div class="page-header" id="page-header">
								<h1><small>Detail / Deskripsi</small></h1>
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
								
								<?
								$penghuni = ($item->penghuni == 1 ? "pria" : ($item->penghuni == 2 ? "wanita" : ($item->penghuni == 3 ? "karyawan" : ($item->penghuni == 4 ? "karyawati" : ($item->penghuni == 5 ? "Pria dan wanita" : ($item->penghuni == 6 ? "suami istri" : "-"))))));
								$penghuni_m = ($item->penghuni_mayoritas == 1 ? "Pelajar/mahasiswa" : ($item->penghuni_mayoritas == 2 ? "keluarga" : ($item->penghuni_mayoritas == 3 ? "karyawan" : ($item->penghuni_mayoritas == 4 ? "karyawati" : ""))));
								?>
								
								<div style="width:50%;float:left;margin-right:20px;">
									<i class="icon icon-check"></i> <span>KODE POS : </span><?php echo $item->kodepos; ?> <br/>
									<i class="icon icon-check"></i> <span>DEKAT DENGAN : </span><?php echo $item->dekat_dgn; ?> <br/>
									<i class="icon icon-check"></i> <span>PERUNTUKKAN PENGHUNI : </span><?php echo $penghuni; ?> <br/>
								</div>
								<div style="width:45%;float:left">
									<i class="icon icon-check"></i> <span>MAYORITAS PENGHUNI : </span><?php echo $penghuni_m; ?> <br/>
									<i class="icon icon-check"></i> <span>1 RUMAH DGN PEMILIK : </span><?php echo $item->with_owner; ?> <br/>
								</div>
							</div>
							<div class="page-header" id="page-header" style="margin:10px 0 10px 0;">
								<h1><small>Fasilitas Lokasi</small></h1> <!--<span class="label" style="float:right;margin:-30px 0 0 0px;padding:4px;">Edit Fasilitas Lokasi</span>-->
							</div>
							<div id="detail_wrapper">
								<?php foreach($fasilitas_lokasi as $row):?>
									<div style="width:33.333%;float:left">
										<?php echo ($row->keamanan == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Keamanan <br/>
										<?php echo ($row->banjir == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Aman banjir <br/>
										<?php echo ($row->univ == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Dekat universitas <br/>
									</div>
									<div style="width:33.333%;float:left">
										<?php echo ($row->pasar == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Dekat pasar <br/>
										<?php echo ($row->kendaraan == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Jalur kendaraan umum <br/>
									</div>
									<div style="width:33.333%;float:left">
										<?php echo ($row->sekolah == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Dekat sekolah <br/>
										<?php echo ($row->toko == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Dekat pertokoan / mall <br/>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="page-header" id="page-header" style="margin:10px 0 10px 0;">
								<h1><small>Fasilitas Kamar</small></h1> <!--<span class="label" style="float:right;margin:-30px 0 0 0px;padding:4px;">Edit Fasilitas Kamar</span>-->
							</div>
							<div id="detail_wrapper">
								<?php foreach($fasilitas_kamar as $row):?>
									<div style="width:33.333%;float:left">
										<?php echo ($row->kmr_ac == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> AC <br/>
										<?php echo ($row->kipas == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Kipas angin <br/>
										<?php echo ($row->meja == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Meja / kursi <br/>
										<?php echo ($row->rakbuku == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Rak buku <br/>
									</div>
									<div style="width:33.333%;float:left">
										<?php echo ($row->tvcable == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> TV Cable <br/>
										<?php echo ($row->shower == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Shower (hot & cold) <br/>
										<?php echo ($row->telkamar == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Telepon kamar <br/>
										<?php echo ($row->tmptidur == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Tempat tidur <br/>
									</div>
									<div style="width:33.333%;float:left">
										<?php echo ($row->lemari == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Lemari <br/>
										<?php echo ($row->lcd == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> LCD TV <br/>
										<?php echo ($row->mandidlm == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Kamar mandi di dalam <br/>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="page-header" id="page-header" style="margin:10px 0 10px 0;">
								<h1><small>Fasilitas Kost</small></h1> <!-- <span class="label" style="float:right;margin:-30px 0 0 0px;padding:4px;">Edit Fasilitas Kost</span>-->
							</div>
							<div id="detail_wrapper">
								<?php foreach($fasilitas_kost as $row):?>
									<div style="width:33.333%;float:left">
										<?php echo ($row->dapur == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Dapur <br/>
										<?php echo ($row->catering == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Catering <br/>
										<?php echo ($row->internet == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Internet <br/>
										<?php echo ($row->rtamu == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Ruang tamu <br/>
									</div>
									<div style="width:33.333%;float:left">
										<?php echo ($row->parkir == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Tempat parkir <br/>
										<?php echo ($row->jammalam == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Batas jam malam / berkunjung <br/>
										<?php echo ($row->cctv == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> CCTV <br/>
									</div>
									<div style="width:33.333%;float:left">
										<?php echo ($row->prt == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Pembantu rumah tangga <br/>
										<?php echo ($row->olhraga == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Fasilitas olahraga <br/>
										<?php echo ($row->cucisetrika == 1 ? "<img src='".base_url()."file/img/icon_yes.png'/>" : "<img src='".base_url()."file/img/icon_no.png'/>") ?> Cuci & setrika <br/>
									</div>
								<?php endforeach; ?>
							</div>
							
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
								<h1><small>Foto</small></h1>
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
						</fieldset>
						<?php endforeach; ?>