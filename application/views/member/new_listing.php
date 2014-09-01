
					<script type="text/javascript">
						$(document).ready(function(){
							
							var cat = $("#kategori").val();
							
							if(cat == 1 || cat == 4 || cat == 9 || cat == 12){
								$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
								$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
							}
							else if(cat == 2 || cat == 10){
								$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#fasilitas_lokasi").show();
								$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#ltanah,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
							}
							else if(cat == 3 || cat == 11){
								$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#ltanah,#arah,#fasilitas_lokasi").show();
								$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#fasilitas_kios,#dlistrik,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
							}
							else if(cat == 5 || cat == 13){
								$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#dlistrik,#fasilitas_lokasi,#fasilitas_kios").show();
								$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#ltanah,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
							}
							else if(cat == 6 || cat == 14){
								$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#jlantai,#ltanah").show();
								$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost,#fasilitas_lokasi,#fasilitas_kios").hide();
							}
							else if(cat == 15){
								$("#judul,#kabupaten,#harga,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#keterangan,#listing_photo,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").show();
								$("#kondisi,#sertifikat,#mls,#status,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios").hide();
							}
							else if(cat == 7){
								$("#judul,#status,#keterangan,#harga,#listing_photo,").show();
								$("#alamat,#kondisi,#sertifikat,#mls,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios,#kabupaten,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").hide();
							}
							else{
								$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
								$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
							}
							
							
							$("#kategori").change(function(){
								
								var cat = this.value;
								if(cat == 1 || cat == 4 || cat == 9 || cat == 12){
									$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
									$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
								}
								else if(cat == 2 || cat == 10){
									$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#fasilitas_lokasi").show();
									$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#ltanah,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
								}
								else if(cat == 3 || cat == 11){
									$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#ltanah,#arah,#fasilitas_lokasi").show();
									$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#fasilitas_kios,#dlistrik,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
								}
								else if(cat == 5 || cat == 13){
									$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#dlistrik,#fasilitas_lokasi,#fasilitas_kios").show();
									$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#ltanah,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
								}
								else if(cat == 6 || cat == 14){
									$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#jlantai,#ltanah").show();
									$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost,#fasilitas_lokasi,#fasilitas_kios").hide();
								}
								else if(cat == 15){
									$("#judul,#kabupaten,#harga,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#keterangan,#listing_photo,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").show();
									$("#kondisi,#sertifikat,#mls,#status,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios").hide();
								}
								else if(cat == 7){
									$("#kabupaten,#judul,#status,#keterangan,#harga,#listing_photo,").show();
									$("#alamat,#kondisi,#sertifikat,#mls,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").hide();
								}
								else{
									$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
									$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
								}
								
								
								
								var windowH = $(window).height();
								var windowW = $(window).width();
								var leftH = $('#left_wrapper').outerHeight(true);
								var rightH = $('#right_wrapper').outerHeight(true);

								var gap = $('#right_wrapper').outerHeight(true) - $('#left_wrapper').outerHeight(true) + 20;
								var gap2 = $('#left_wrapper').outerHeight(true) - $('#right_wrapper').outerHeight(true) - 20;
							   
								var rightOffset =  $('#right_wrapper').outerHeight(true) - windowH + 160;
								var leftOffset = $('#left_wrapper').outerHeight(true) - windowH + 165;
								var sisaWindow = ($(window).width() - $('#content_wrapper').outerWidth(true)) / 2;
								var padding = 10;
							   
								$(window).scroll(function() {
									var scrollVal = $(this).scrollTop();
									if(leftH > rightH){

										var leftMargin = $('#left_wrapper').outerWidth(true) + sisaWindow + padding;
										var topMarginGap = $('#left_wrapper').outerHeight(true) - $('#right_wrapper').outerHeight(true) - 20;
										
										if(scrollVal > rightOffset){
											if(scrollVal < leftOffset){
												$('#right_wrapper').css({'position':'fixed','bottom': '20px','left' : leftMargin + 'px'});
											}
											else{
												$('#right_wrapper').css({'position':'relative','float':'left','margin':gap2 + 'px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
											}
										}
										else{
											$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
										}
									}
									else{
										
										var leftMargin = sisaWindow + padding;
										var leftMarginForSidebar = $('#left_wrapper').outerWidth(true);
										
										if(scrollVal > leftOffset){
											if(scrollVal < rightOffset){
												$('#left_wrapper').css({'position':'fixed','bottom': '20px','left' : leftMargin + 'px'});
												$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 ' + leftMarginForSidebar + 'px','width':'240px','left':'0px','bottom':'0px'});
											}
											else{
												$('#left_wrapper').css({'position':'relative','left' : '0px','float':'left','margin': gap + 'px 0 0 0'});
												$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
											}
										}
										else{
											$('#left_wrapper').css({'position':'relative','bottom': '0px','left' : '0px','float':'left','margin':'0 0 0 0px'});
											$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
										}
									}
								});
								
								
							});
							
							$("#show_map").change(function(){
								var x = this.value;
								if(x == 0){
									$("#map_wrapper").hide();
								}
								else{
									$("#map_wrapper").show();
								}
							});
						});
					</script>
						
					<!-- Attach JS File -->
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
						
					<script type="text/javascript">
						var geocoder = new google.maps.Geocoder();
						function updateMarkerPosition(latLng) {
						  document.getElementById('latitude').value = latLng.lat();
						  document.getElementById('longitude').value = latLng.lng();
						}
						function updateZoomLevel(zoomLevel) {
						  document.getElementById('zoomlevel').value = zoomLevel;
						}
						function initialize() {
						  var latLng = new google.maps.LatLng(-4.938964184545017,119.919370125);
						  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
							zoom: 8,
							center: latLng,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						  });
						  var marker = new google.maps.Marker({
							position: latLng,
							title: 'Drag marker ini ke lokasi properti anda',
							map: map,
							draggable: true,
							icon: new google.maps.MarkerImage(
								"<?php echo base_url();?>file/img/point2.png", // reference from your base
								new google.maps.Size(50, 40), // size of image to capture
								new google.maps.Point(0, 0), // start reference point on image (upper left)
								new google.maps.Point(13, 40), // point on image to center on latlng (scaled)
								new google.maps.Size(50, 40) // actual size on map
							)
						  });
						  updateMarkerPosition(latLng);
						  updateZoomLevel(map.getZoom());
						  google.maps.event.addListener(marker, 'drag', function() {
							updateMarkerPosition(marker.getPosition());
						  });
						  google.maps.event.addListener(map, 'zoom_changed', function() {
							updateZoomLevel(map.getZoom());
						  });
						}
						// Onload handler to fire off the app.
						google.maps.event.addDomListener(window, 'load', initialize);
					</script>
					
					<div id="inside_main_wrapper">
						
						<?php if($message != null){ ?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						<?php echo form_open_multipart("member_listing/save_listing/".$id_paket,array("class"=>"form-horizontal","name"=>"form")); ?>
						<fieldset>
							<legend>Pasang Listing <small> | Field dengan tanda bintang(*) harus diisi.</small></legend>
							
							<div class="control-group">
								<label class="control-label"><b>Kategori:</b></label>
								<div class="controls docs-input-sizes">
									<select name="kategori" size="1" class="span3" id="kategori">
										<?php foreach($kategori as $row): ?>
												<option value="<?php echo $row->id_kategori; ?>" <?php if($row->id_kategori == set_value('kategori')){echo "selected";} ?>><?php echo $row->nama_kategori; ?></option>
										<?php endforeach; ?>
									</select>*<i><small><?php echo form_error('kategori'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="judul">
								<label class="control-label">Judul Listing:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="judul" value="<?php echo set_value('judul'); ?>" />*<i><small><?php echo form_error('judul'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="status">
								<label class="control-label">Status:</label>
								<div class="controls docs-input-sizes">
									<select name="status"  size="1" class="span3">
										<option value="1" <?php if(set_value('status') == 1){echo "selected";}?>>Kontraktor</option>
										<option value="2" <?php if(set_value('status') == 2){echo "selected";}?>>Arsitektur</option>
										<option value="3" <?php if(set_value('status') == 3){echo "selected";}?>>Kontraktor dan Arsitektur</option>
										<option value="4" <?php if(set_value('status') == 4){echo "selected";}?>>Toko Bahan Bangunan</option>
										<option value="5" <?php if(set_value('status') == 5){echo "selected";}?>>Tukang / Buruh Bangunan</option>
									</select>*<i><small><?php echo form_error('status'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="kabupaten">
								<label class="control-label">Kabupaten/Kota:</label>
								<div class="controls docs-input-sizes">
									<select name="kabupaten"  size="1" class="span3">
										<option value="">Pilih Kabupaten/Kota</option>
										<?php foreach($kabupaten as $row): ?>
												<option value="<?php echo $row->id_kabupaten; ?>" <?php if($row->id_kabupaten == set_value('kabupaten')){echo "selected";} ?>><?php echo ucfirst(strtolower($row->nama_kabupaten)); ?></option>
										<?php endforeach; ?>
									</select>*<i><small><?php echo form_error('kabupaten'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="harga">
								<label class="control-label">Harga:</label>
								<div class="controls docs-input-sizes">
									<div class="input-prepend">
										<span class="add-on">Rp. </span><input class="span3" type="text" name="harga"  value="<?php echo set_value('harga'); ?>" />
									</div>* <i><small><?php echo form_error('harga'); ?></small></i>
									<p class="help-block"><small>Anda dapat menggunakan format harga, misal : 300 juta, 300.000.000, 700 jt, 7M, 7 Miliar / dll (Contoh untuk properti sewa/kostan gunakan : 500ribu/bulan, 250rb/hari, 1,5juta/tahun)</small></p>
								</div>
							</div>
							
							
							<div class="control-group" id="alamat">
								<label class="control-label">Alamat:</label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span4" name="alamat"  style="resize:none;"><?php echo set_value('alamat');?></textarea>*<i><?php echo form_error('alamat'); ?></i>
									<p class="help-block" style="float:left;margin-top:5px;"><small><font color="red">HARAP DIPERHATIKAN!</font> Isikan alamat dengan benar dan lengkap. karena setelah anda submit properti anda, data alamat tidak dapat diedit lagi. </small></p>
								</div>
							</div>
							
							<div class="control-group" id="penghuni">
								<label class="control-label" style="margin-top:-10px;">Peruntukkan penghuni:</label>
								<div class="controls docs-input-sizes">
									<select name="penghuni"  size="1" class="span3">
										<option value="" <?php if(set_value('penghuni') == null){echo "selected";}?>>Pilih</option>
										<option value="1" <?php if(set_value('penghuni') == 1){echo "selected";}?>>Pria</option>
										<option value="2" <?php if(set_value('penghuni') == 2){echo "selected";}?>>Wanita</option>
										<option value="3" <?php if(set_value('penghuni') == 3){echo "selected";}?>>Karyawan</option>
										<option value="4" <?php if(set_value('penghuni') == 4){echo "selected";}?>>Karyawati</option>
										<option value="5" <?php if(set_value('penghuni') == 5){echo "selected";}?>>Pria dan Wanita</option>
										<option value="6" <?php if(set_value('penghuni') == 6){echo "selected";}?>>Suami istri/keluarga</option>
									</select><i><small><?php echo form_error('penghuni'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="penghuni_mayoritas">
								<label class="control-label">Mayoritas penghuni:</label>
								<div class="controls docs-input-sizes">
									<select name="penghuni_mayoritas"  size="1" class="span3">
										<option value="" <?php if(set_value('penghuni_mayoritas') == null){echo "selected";}?>>Pilih</option>
										<option value="1" <?php if(set_value('penghuni_mayoritas') == 1){echo "selected";}?>>Mahasiswa/pelajar</option>
										<option value="2" <?php if(set_value('penghuni_mayoritas') == 2){echo "selected";}?>>Keluarga</option>
										<option value="3" <?php if(set_value('penghuni_mayoritas') == 3){echo "selected";}?>>Karyawan</option>
										<option value="4" <?php if(set_value('penghuni_mayoritas') == 4){echo "selected";}?>>Karyawati</option>
									</select><i><small><?php echo form_error('penghuni_mayoritas'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="kondisi">
								<label class="control-label">Kondisi:</label>
								<div class="controls docs-input-sizes">
									<select name="kondisi" size="1" class="span2">
										<option value="1" <?php if(set_value('kondisi') == 1){echo "selected";}?>>baru</option>
										<option value="2" <?php if(set_value('kondisi') == 2){echo "selected";}?>>bekas</option>
									</select>*<i><small><?php echo form_error('kondisi'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="kodepos">
								<label class="control-label">Kode pos:</label>
								<div class="controls docs-input-sizes">
									<input class="span2" type="text" name="kodepos"  value="<?php echo set_value('kodepos'); ?>" /><i><small><?php echo form_error('kodepos'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="sertifikat">
								<label class="control-label">Serifikat:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="sertifikat"  value="<?php echo set_value('sertifikat'); ?>" /><i><small><?php echo form_error('sertifikat'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="mls">
								<label class="control-label">MLS:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="mls"  value="<?php echo set_value('mls'); ?>" /><i><small><?php echo form_error('mls'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="keterangan">
								<label class="control-label">Keterangan / Deskripsi:</label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span4" name="keterangan"  style="resize:none;"><?php echo set_value('keterangan');?></textarea><i><?php echo form_error('keterangan'); ?></i>
								</div>
							</div>
							
							<div class="control-group" id="peta_lokasi">
								<label class="control-label">Peta Lokasi:</label>
								<div class="controls docs-input-sizes">
									Tampilkan peta : 
									<select name="show_map" id="show_map"/>
										<option value="1">Ya</option>
										<option value="0">Tidak</option>
									</select>
									<div id="map_wrapper">
										<div id="mapCanvas" class="thumbnail" style="width:500px;height:250px;"></div>
										<div id="infopeta">
											<div class="input-prepend" style="margin-right:5px;">
												<span class="add-on">Latitude</span>
												<input type="text" name="latitude" id="latitude" value="" readonly="no" />
											</div>
											<div class="input-prepend" style="margin-right:5px;">
												<span class="add-on">Longitude</span>
												<input type="text" name="longitude" id="longitude" value="" readonly="no" />
											</div>
											<div class="input-prepend">
												<span class="add-on">Zoom level</span>
												<input type="text" name="zoom_level" id="zoomlevel" value="" readonly="no" style="width:30px" />
											</div>
										</div>
										<p class="help-block" style="float:left;margin-top:5px;"><small>Geser Drag Marker ke posisi lokasi properti anda dan anda juga dapat zoom/memperbesar peta dengan cara memilih tombol (+)/(-) pada bagian kiri atas peta atau menggunakan scroll pada mouse anda</small></p>
									</div>
								</div>
							</div>
							
							<div class="control-group" id="listing_photo">
								<label class="control-label">Foto Iklan Listing:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="file" name="listing_photo"  value="<?php echo set_value('listing_photo'); ?>" /><i><small><?php echo form_error('listing_photo'); ?></small></i>
									<p class="help-block" style="float:left;margin-top:5px;"><small>Ukuran file yang direkomendasikan : dibawah 3mb. Anda dapat menambah foto listing anda pada fitur edit listing, dan memilih 'tambah foto listing' pada bagian foto. anda dapat mengupload maksimal <?php echo ($status_paket == 1 ? 7 : 3); ?> foto listing.</small></p>
								</div>
							</div>
							
							<div class="control-group" id="with_owner">
								<label class="control-label" style="margin-top:-12px">1 rumah dengan pemilik kost:</label>
								<div class="controls docs-input-sizes">
									<select name="with_owner" size="1" class="span1">
										<option value="1" <?php if(set_value('with_owner') == 1){echo "selected";}?>>Ya</option>
										<option value="2" <?php if(set_value('with_owner') == 2){echo "selected";}?>>Tidak</option>
									</select><i><small><?php echo form_error('with_owner'); ?></small></i>
								</div>
							</div>
							
							<div class="control-group" id="dekat_dgn">
								<label class="control-label">Dekat dengan:</label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span4" name="dekat_dgn"  style="resize:none;"><?php echo set_value('dekat_dgn');?></textarea><i><?php echo form_error('dekat_dgn'); ?></i>
								</div>
							</div>
							
							<hr/>
							
							<div style="width:50%;float:left">
							
								<div class="control-group" id="jlantai">
									<label class="control-label">Jumlah lantai:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="20px;" src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png"/>&nbsp;</span><input class="span1" id="prependedInput" name="jlantai"  size="3" type="text" value="<?php echo set_value('jlantai'); ?>" />
									  </div>
									  <i><?php echo form_error('jlantai'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="garage">
									<label class="control-label">Garasi:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_garage.png"/></span><input class="span1" id="prependedInput" name="garage"  size="3" type="text" value="<?php echo set_value('garage'); ?>" />
									  </div>
									  <i><?php echo form_error('garage'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="pembantu">
									<label class="control-label">Kamar pembantu:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_pembantu.png"/></span><input class="span1" id="prependedInput" name="pembantu"  size="3" type="text" value="<?php echo set_value('pembantu'); ?>" />
									  </div>
									  <i><?php echo form_error('pembantu'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="sumberair">
									<label class="control-label">Sumber air:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_water.png"/></span><input class="span1" id="prependedInput" name="sumberair"  size="3" type="text" value="<?php echo set_value('sumberair'); ?>" />
									  </div>
									  <i><?php echo form_error('sumberair'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="ltanah">
									<label class="control-label">Luas Tanah:</label>
									<div class="controls">
									  <div class="input-prepend input-append">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_garden.png"/></span><input class="span1" id="appendPrependedInput" name="ltanah" size="3" type="text" value="<?php echo set_value('ltanah'); ?>" /><span class="add-on">M<sup>2</sup></span>
									  </div>
									  <i><?php echo form_error('ltanah'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="arah">
									<label class="control-label">Arah Mata Angin:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="22px;" src="<?php echo base_url(); ?>file/img/icon_compas.png"/></span>
										<select name="arah" id="prependedInput" class="span1">
											<option value="">-</option>
											<option value="Utara">Utara</option>
											<option value="Selatan">Selatan</option>
											<option value="Barat">Barat</option>
											<option value="Timur">Timur</option>
											<option value="Tenggara">Tenggara</option>
											<option value="Barat Daya">Barat Daya</option>
											<option value="Barat Laut">Barat Laut</option>
											<option value="Timur Laut">Timur Laut</option>
										</select>
									  </div>
									  <i><?php echo form_error('arah'); ?></i>
									</div>
								 </div>
							 
							</div>
							
							<div style="width:50%;float:left">
							
								<div class="control-group" id="ktidur">
									<label class="control-label">Jumlah Kamar Tidur:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_bedroom.png"/></span><input class="span1" id="prependedInput" name="ktidur" size="3" type="text" value="<?php echo set_value('ktidur'); ?>" />
									  </div>
									  <i><?php echo form_error('ktidur'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="kmandi">
									<label class="control-label">Jumlah Kamar Mandi:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_bathroom.png"/></span><input class="span1" id="prependedInput" name="kmandi" size="3" type="text" value="<?php echo set_value('kmandi'); ?>" />
									  </div>
									  <i><?php echo form_error('kmandi'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="dlistrik">
									<label class="control-label">Daya Listrik:</label>
									<div class="controls">
									  <div class="input-prepend input-append">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_listrik.png"/></span><input class="span1" id="appendPrependedInput" name="dlistrik" size="3" type="text" value="<?php echo set_value('dlistrik'); ?>" /><span class="add-on">Watt</span>
									  </div>
									  <i><?php echo form_error('dlistrik'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="furniture">
									<label class="control-label">Furniture:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><img width="25px;" src="<?php echo base_url(); ?>file/img/icon_home.png"/></span>
										<select name="furniture" size="1" style="width:120px;height:30px;">
											<option value="1" <?php if(set_value('furniture') == 1){echo "selected";}?>>furnished</option>
											<option value="2" <?php if(set_value('furniture') == 2){echo "selected";}?>>semi furnished</option>
											<option value="3" <?php if(set_value('furniture') == 3){echo "selected";}?>>unfurnished</option>
										</select>
									  </div>
									  <i><?php echo form_error('furniture'); ?></i>
									</div>
								 </div>
								 
								 <div class="control-group" id="lbangunan">
									<label class="control-label">Luas bagunan:</label>
									<div class="controls">
									  <div class="input-prepend input-append">
										<span class="add-on"><img width="25px" src="<?php echo base_url(); ?>file/img/icon_luas.png"/></span><input class="span1" id="appendPrependedInput" name="lbangunan" size="3" type="text" value="<?php echo set_value('lbangunan'); ?>" /><span class="add-on">M<sup>2</sup></span>
									  </div>
									  <i><?php echo form_error('lbangunan'); ?></i>
									</div>
								 </div>
								 
							 
							</div>
							
							<div style="width:100%;float:left">
								<hr/>
								<div id="fasilitas_lokasi" style="width:100%;float:left;">
								<div style="width:45%;float:left;">
									<label class="control-label">Fasilitas Lokasi:</label>
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="keamanan" id="keamanan" value="1" <?php if(set_value('keamanan') == 1){echo "checked";} ?> /> Keamanan
									</label>
									<label class="checkbox">
										<input type="checkbox" name="banjir" id="banjir" value="1" <?php if(set_value('banjir') == 1){echo "checked";} ?> /> Aman banjir
									</label>
									<label class="checkbox">
										<input type="checkbox" name="univ" id="univ" value="1" <?php if(set_value('univ') == 1){echo "checked";} ?> /> Dekat universitas
									</label>
									<label class="checkbox">
										<input type="checkbox" name="pasar" id="pasar" value="1" <?php if(set_value('pasar') == 1){echo "checked";} ?> /> Dekat pasar
									</label>
									</div>
								 </div>
								 
								 <div style="width:55%;float:left;margin-left:-100px;">
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="kendaraan" id="kendaraan" value="1" <?php if(set_value('kendaraan') == 1){echo "checked";} ?> /> Jalur kendaraan umum
									</label>
									<label class="checkbox">
										<input type="checkbox" name="sekolah" id="sekolah" value="1" <?php if(set_value('sekolah') == 1){echo "checked";} ?> /> Dekat sekolah
									</label>
									<label class="checkbox">
										<input type="checkbox" name="toko" id="toko" value="1" <?php if(set_value('toko') == 1){echo "checked";} ?> /> Dekat pertokoan / mall
									</label>
									</div>
								 </div>
								</div>
								
								<div id="fasilitas_kios" style="width:100%;float:left;">
								<hr/>
								<div style="width:45%;float:left;">
									<label class="control-label">Fasilitas Kios:</label>
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="ac" id="ac" value="1" <?php if(set_value('ac') == 1){echo "checked";} ?> /> AC
									</label>
									<label class="checkbox">
										<input type="checkbox" name="lift" id="lift" value="1" <?php if(set_value('lift') == 1){echo "checked";} ?> /> Lift
									</label>
									</div>
								 </div>
								 
								 <div style="width:55%;float:left;margin-left:-100px;">
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="parkir" id="parkir" value="1" <?php if(set_value('parkir') == 1){echo "checked";} ?> /> Parkir
									</label>
									<label class="checkbox">
										<input type="checkbox" name="kantin" id="kantin" value="1" <?php if(set_value('kantin') == 1){echo "checked";} ?> /> Kantin / Food court
									</label>
									</div>
								 </div>
								</div>
								
								<div id="fasilitas_kamar" style="width:100%;float:left;">
								<hr/>
								<div style="width:45%;float:left;">
									<label class="control-label">Fasilitas Kamar:</label>
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="kmr_ac" id="kmr_ac" value="1" <?php if(set_value('kmr_ac') == 1){echo "checked";} ?> /> AC
									</label>
									<label class="checkbox">
										<input type="checkbox" name="kipas" id="kipas" value="1" <?php if(set_value('kipas') == 1){echo "checked";} ?> /> Kipas angin
									</label>
									<label class="checkbox">
										<input type="checkbox" name="meja" id="meja" value="1" <?php if(set_value('meja') == 1){echo "checked";} ?> /> Meja/kursi
									</label>
									<label class="checkbox">
										<input type="checkbox" name="rakbuku" id="rakbuku" value="1" <?php if(set_value('rakbuku') == 1){echo "checked";} ?> /> Rak buku
									</label>
									<label class="checkbox">
										<input type="checkbox" name="tvcable" id="tvcable" value="1" <?php if(set_value('tvcable') == 1){echo "checked";} ?> /> TV Cable
									</label>
									<label class="checkbox">
										<input type="checkbox" name="shower" id="shower" value="1" <?php if(set_value('shower') == 1){echo "checked";} ?> /> Shower(hot & cold)
									</label>
									</div>
								 </div>
								 
								 <div style="width:55%;float:left;margin-left:-100px;">
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="telkamar" id="telkamar" value="1" <?php if(set_value('telkamar') == 1){echo "checked";} ?> /> Telepon kamar
									</label>
									<label class="checkbox">
										<input type="checkbox" name="tmptidur" id="tmptidur" value="1" <?php if(set_value('tmptidur') == 1){echo "checked";} ?> /> Tempat tidur
									</label>
									<label class="checkbox">
										<input type="checkbox" name="lemari" id="lemari" value="1" <?php if(set_value('lemari') == 1){echo "checked";} ?> /> Lemari pakaian
									</label>
									<label class="checkbox">
										<input type="checkbox" name="lcd" id="lcd" value="1" <?php if(set_value('lcd') == 1){echo "checked";} ?> /> LCD / TV
									</label>
									<label class="checkbox">
										<input type="checkbox" name="mandidlm" id="mandidlm" value="1" <?php if(set_value('mandidlm') == 1){echo "checked";} ?> /> Kamar mandi di dalam
									</label>
									</div>
								 </div>
								</div>
								
								<div id="fasilitas_kost" style="width:100%;float:left;">
								<hr/>
								<div style="width:45%;float:left;">
									<label class="control-label">Fasilitas Kost:</label>
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="dapur" id="dapur" value="1" <?php if(set_value('dapur') == 1){echo "checked";} ?> /> Dapur
									</label>
									<label class="checkbox">
										<input type="checkbox" name="catering" id="catering" value="1" <?php if(set_value('catering') == 1){echo "checked";} ?> /> Catering
									</label>
									<label class="checkbox">
										<input type="checkbox" name="internet" id="internet" value="1" <?php if(set_value('internet') == 1){echo "checked";} ?> /> Internet
									</label>
									<label class="checkbox">
										<input type="checkbox" name="rtamu" id="rtamu" value="1" <?php if(set_value('rtamu') == 1){echo "checked";} ?> /> Ruang Tamu
									</label>
									<label class="checkbox">
										<input type="checkbox" name="parkiran" id="parkiran" value="1" <?php if(set_value('parkiran') == 1){echo "checked";} ?> /> Parkir
									</label>
									</div>
								 </div>
								 
								 <div style="width:55%;float:left;margin-left:-100px;">
									<div class="controls">
									<label class="checkbox">
										<input type="checkbox" name="jammalam" id="jammalam" value="1" <?php if(set_value('jammalam') == 1){echo "checked";} ?> /> Batas Jam malam / berkunjung
									</label>
									<label class="checkbox">
										<input type="checkbox" name="cctv" id="cctv" value="1" <?php if(set_value('cctv') == 1){echo "checked";} ?> /> CCTV
									</label>
									<label class="checkbox">
										<input type="checkbox" name="prt" id="prt" value="1" <?php if(set_value('prt') == 1){echo "checked";} ?> /> Pembantu rumah tangga
									</label>
									<label class="checkbox">
										<input type="checkbox" name="olhraga" id="olhraga" value="1" <?php if(set_value('olhraga') == 1){echo "checked";} ?> /> Fasilitas Olahraga
									</label>
									<label class="checkbox">
										<input type="checkbox" name="cucisetrika" id="cucisetrika" value="1" <?php if(set_value('cucisetrika') == 1){echo "checked";} ?> /> Cuci & Setrika
									</label>
									</div>
								 </div>
								</div>
								 
								<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
									<button type="submit" class="btn btn-primary btn-large">Pasang Listing</button>
									<button type="submit" class="btn btn-large">Cancel</button>
								</div>
							</div>
							
						</fieldset>
					</div>
				