
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
								<?php echo anchor("listing_manager/edit_listing/".$item->id_listing_member,"Edit Listing",array('class'=>'label'))?>
								<?php echo anchor("listing_manager/delete_listing/".$item->id_listing_member,"Hapus Listing",array('class'=>'label'))?>
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
								
								<div class="page-header" id="page-header">
									<h1><small></small></h1>
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
								<h1><small></small></h1>
							</div>
							<div id="detail_wrapper">
								<div style="width:50%;float:left;margin-right:20px;">
									<img src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png" width="15px" style="margin-top:-5px;"/> <span>JUMLAH LANTAI : </span> <?php echo ($item->jml_lantai == 0 || $item->jml_lantai == null ? "-" : $item->jml_lantai); ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_bedroom.png" width="20px" style="margin-top:-5px;"/> <span>KAMAR TIDUR : </span> <?php echo ($item->jml_ktidur == 0 || $item->jml_ktidur == null ? "-" : $item->jml_ktidur); ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_bathroom.png" width="20px" style="margin-top:-5px;"/> <span>KAMAR MANDI : </span> <?php echo ($item->jml_kmandi == 0 || $item->jml_kmandi == null ? "-" : $item->jml_kmandi); ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_pembantu.png" width="20px" style="margin-top:-5px;"/> <span>KAMAR PEMBANTU : </span> <?php echo ($item->pembantu == 0 || $item->pembantu == null ? "-" : $item->pembantu); ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_luas.png" width="20px" style="margin-top:-5px;"/> <span>LUAS BANGUNAN : </span> <?php echo ($item->luas_bangunan == 0 || $item->luas_bangunan == null ? "-" : $item->luas_bangunan); ?> M<sup>2</sup> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_garden.png" width="20px" style="margin-top:-5px;"/> <span>LUAS TANAH : </span> <?php echo ($item->luas_tanah == 0 || $item->luas_tanah == null ? "-" : $item->luas_tanah); ?> M<sup>2</sup> <br/>
								</div>
								<div style="width:45%;float:left">
									<img src="<?php echo base_url(); ?>file/img/icon_garage.png" width="20px" style="margin-top:-5px;"/> <span>GARASI : </span> <?php echo ($item->garasi == 0 || $item->garasi == null ? "-" : $item->garasi); ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_home.png" width="20px" style="margin-top:-5px;"/> <span>FURNITURE : </span> <?php echo $item->furniture; ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_listrik.png" width="20px" style="margin-top:-5px;"/> <span>DAYA LISTRIK : </span> <?php echo $item->daya_listrik; ?> Watt<br/>
									<img src="<?php echo base_url(); ?>file/img/icon_water.png" width="20px" style="margin-top:-5px;"/> <span>SUMBER AIR : </span> <?php echo $item->sumber_air; ?> <br/>
									<img src="<?php echo base_url(); ?>file/img/icon_compas.png" width="20px" style="margin-top:-5px;"/> <span>ARAH MATA ANGIN : </span> <?php echo $item->mata_angin; ?> <br/>
								</div>
							</div>
							<div class="page-header" id="page-header" style="margin-top:10px">
								<h1><small>Fasilitas Lokasi</small></h1>
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