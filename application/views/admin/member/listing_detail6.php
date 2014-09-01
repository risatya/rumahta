
					<div id="cpanel_wrapper">
						
						<h3>Member Manager : Listing Detail</h3>
						
						<div class="navbar" style="float:left;width:100%;margin-top:20px;">
						  <div class="navbar-inner">
							<form class="navbar-form pull-left">
							  <input type="text" class="span3">
							  <button type="submit" class="btn">Cari Member</button>
							</form>
						  </div>
						</div>
						
						<div style="width:100%;float:left">
					
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						<!--<div class="well" style="padding-bottom:35px">
							<div style="width:47%;float:left;margin-bottom:10px;">
								<?php //foreach($info_paket as $item): ?>
									<i class="icon icon-th-large"></i> Paket Listing : <span class="label label-success"><?php //echo $item->nama_paket; ?></span><br/>
									<i class="icon icon-tasks"></i> Quota untuk pasang Listing : <span class="label label-success"><?php //echo $item->quota; ?> Listing</span>
								<?php //endforeach; ?>
							</div>
							<div style="width:53%;float:right;">
								<div class="btn-group">
								  <?php //echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
								  <?php ///echo anchor("#","<i class='icon icon-arrow-up'></i> Upgrade Paket Listing",array("class"=>"btn")); ?>
								</div>
							</div>
						</div>-->
						<?php foreach($listing as $item ):?>
						<fieldset>
							<legend style="float:left;width:670px;">
								<div style="float:left;margin-right:10px;"><?php echo $item->judul; ?></div>
								<?php echo anchor("member_manager/edit_listing/".$item->id_listing_member."/".$id_user,"Edit Listing",array('class'=>'label'))?>
								<?php echo anchor("member_manager/delete_listing/".$item->id_listing_member."/".$id_user,"Hapus Listing",array('class'=>'label'))?>
							</legend>
							<?php foreach($paket_listing as $row): ?>
								<?php $x = 0; ?>
								<?php foreach($listing_cover as $cover): ?>
									<?php $photoname = $cover->listing_photo_thumb; $x++; ?>
								<?php endforeach; ?>
								<?php if($x == 0){$photoname = "default.jpg"; } ?>
								<?php if($row->status_paket == 1){ ?>
									<img src="<?php echo base_url(); ?>file/img/free/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" style="margin-right : 10px;" />
								<?php } else {?>
									<img src="<?php echo base_url(); ?>file/img/premium/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" style="margin-right : 10px;" />
								<?php } ?>
								
							<?php endforeach; ?>
							<p class="listing_detail">
								<span>KATEGORI : </span><?php echo $item->nama_kategori; ?> <br/>
								<span>HARGA : </span><?php echo "Rp. ".$item->harga; ?> <br/>
								<span>KABUPATEN : </span><?php echo ucfirst(strtolower($item->nama_kabupaten)); ?> <br/>
								<span>ALAMAT : </span><?php echo $item->alamat; ?> <br/>
								<span>KONDISI : </span><?php echo $item->kondisi; ?> <br/>
							</p>
							<div class="page-header" id="page-header">
								<h1><small>Detail</small></h1>
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
									<h1><small></small></h1>
								</div>
								
								<div style="width:50%;float:left;margin-right:20px;">
									<i class="icon icon-check"></i> <span>KODE POS : </span><?php echo $item->kodepos; ?> <br/>
									<i class="icon icon-check"></i> <span>DEKAT DENGAN : </span><?php echo $item->dekat_dgn; ?> <br/>
									<i class="icon icon-check"></i> <span>PERUNTUKKAN PENGHUNI : </span><?php echo $item->penghuni; ?> <br/>
								</div>
								<div style="width:45%;float:left">
									<i class="icon icon-check"></i> <span>MAYORITAS PENGHUNI : </span><?php echo $item->penghuni_mayoritas; ?> <br/>
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
							<div class="page-header" id="page-header" style="margin:10px 0 10px 0;">
								<h1><small>Foto</small></h1>
							</div>
							<div id="detail_wrapper">
							<?php foreach($paket_listing as $row): ?>
								<?php $x = 0; ?>
								<?php foreach($listing_photo as $cover): ?>
									<?php if($row->status_paket == 1){ ?>
										<a href="<?php echo base_url(); ?>file/img/free/<?php echo $cover->listing_photo_big;?>" rel="facebox"><img src="<?php echo base_url(); ?>file/img/free/thumb/<?php echo $cover->listing_photo_thumb; ?>" class="thumbnail" align="left" style="margin-right : 9px;" width="148px" /></a>
									<?php } else {?>
										<a href="<?php echo base_url(); ?>file/img/premium/<?php echo $cover->listing_photo_big;?>" rel="facebox"><img src="<?php echo base_url(); ?>file/img/premium/thumb/<?php echo $cover->listing_photo_thumb; ?>" class="thumbnail" align="left" style="margin-right : 9px;" width="148px" /></a>
									<?php } $x++; ?>
								<?php endforeach; ?>
							<?php endforeach; ?>
							</div>
						</fieldset>
						<?php endforeach; ?>
					</div>
					
				</div>
				
			</div>
					
					<!--attach file css-->
					<link rel="stylesheet" href="<?php echo base_url();?>file/css/facebox.css" type="text/css" />
					
					<!--attach file js -->
					<script type="text/javascript" src="<?php echo base_url(); ?>file/js/facebox.js" ></script>
					
					<script type="text/javascript">
						$(document).ready(function() {
							$('a[rel*=facebox]').facebox(
								{
								loadingImage : '<?php echo base_url(); ?>file/img/facebox/loading.gif',
								closeImage   : '<?php echo base_url(); ?>file/img/facebox/closelabel.png'
								}
							);
						})
					</script>