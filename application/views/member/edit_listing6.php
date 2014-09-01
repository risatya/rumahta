					
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

					<div id="inside_main_wrapper">
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
						
						<?php echo form_open("member_listing/do_edit6/".$item->id_listing_member,array("class"=>"form-horizontal","name"=>"form")); ?>
						
						<fieldset>
						
							<div class="page-header" id="page-header">
								<h1><small>Edit detail listing</small></h1>
							</div>
							
							<div class="control-group">
								<label class="control-label"><b>Judul:</b></label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="judul" value="<?php echo $item->judul; ?>" />*<i><u><?php echo form_error('judul'); ?></u></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label"><b>Harga:</b></label>
								<div class="controls docs-input-sizes">
									<div class="input-prepend">
										<span class="add-on">Rp. </span><input class="span3" type="text" name="harga" value="<?php echo $item->harga; ?>" />*<i><u><?php echo form_error('harga'); ?></u></i>
									</div>* <i><small><?php echo form_error('harga'); ?></small></i>
									<p class="help-block"><small>Anda dapat menggunakan format harga, misal : 300 juta, 300.000.000, 700 jt, 7M, 7 Miliar / dll (Contoh untuk properti sewa/kostan gunakan : 500ribu/bulan, 250rb/harga, 1,5juta/tahun)</small></p>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label"><b>Kabupaten:</b></label>
								<div class="controls docs-input-sizes">
									<select name="kabupaten"  size="1" class="span3">
										<option value="">Pilih Kabupaten</option>
										<?php foreach($kabupaten as $row): ?>
												<option value="<?php echo $row->id_kabupaten; ?>" <?php if($row->id_kabupaten == $item->id_kabupaten){echo "selected";} ?>><?php echo ucfirst(strtolower($row->nama_kabupaten)); ?></option>
										<?php endforeach; ?>
									</select>*<i><u><?php echo form_error('kabupaten'); ?></u></i>
								</div>
							</div>
							
							<div class="control-group" id="alamat">
								<label class="control-label"><b>Alamat:</b></label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span4" name="alamat" readonly="yes" style="resize:none;"><?php echo $item->alamat;?></textarea>*<i><?php echo form_error('alamat'); ?></i>
								</div>
							</div>
							
							<div class="control-group" id="kondisi">
								<label class="control-label"><b>Kondisi:</b></label>
								<div class="controls docs-input-sizes">
									<select name="kondisi" size="1" class="span2">
										<option value="1" <?php if($item->kondisi == "baru"){echo "selected";}?>>baru</option>
										<option value="2" <?php if($item->kondisi == "bekas"){echo "selected";}?>>bekas</option>
									</select>*<i><u><?php echo form_error('kondisi'); ?></u></i>
								</div>
							</div>
							
							<div class="control-group" id="keterangan">
								<label class="control-label"><b>Keterangan:</b></label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span4" name="keterangan"  style="resize:none;"><?php echo $item->keterangan;?></textarea><i><?php echo form_error('keterangan'); ?></i>
								</div>
							</div>
							
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
								  var latLng = new google.maps.LatLng(<?php echo $item->latitude; ?>,<?php echo $item->longitude; ?>);
								  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
									zoom: <?php echo $item->zoom_level; ?>,
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
							
							<div class="control-group" id="peta_lokasi">
								<label class="control-label">Peta Lokasi:</label>
								<div class="controls docs-input-sizes">
									Tampilkan peta : 
									<select name="show_map" id="show_map"/>
										<option value="1" <?php echo ($item->show_map == 1 ? "selected" : ""); ?>>Ya</option>
										<option value="0" <?php echo ($item->show_map == 0 ? "selected" : ""); ?>>Tidak</option>
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
							
							<div class="control-group" id="kodepos">
								<label class="control-label"><b>Kode pos:</b></label>
								<div class="controls docs-input-sizes">
									<input class="span2" type="text" name="kodepos"  value="<?php echo $item->kodepos; ?>" /><i><u><?php echo form_error('kodepos'); ?></u></i>
								</div>
							</div>
							
							<div class="control-group" id="penghuni">
								<label class="control-label" style="margin-top:-10px;"><b>Peruntukkan penghuni:</b></label>
								<div class="controls docs-input-sizes">
									<select name="penghuni"  size="1" class="span3">
										<option value="" <?php if($item->penghuni == null){echo "selected";}?>>Pilih</option>
										<option value="1" <?php if($item->penghuni == 1){echo "selected";}?>>Pria</option>
										<option value="2" <?php if($item->penghuni == 2){echo "selected";}?>>Wanita</option>
										<option value="3" <?php if($item->penghuni == 3){echo "selected";}?>>Karyawan</option>
										<option value="4" <?php if($item->penghuni == 4){echo "selected";}?>>Karyawati</option>
										<option value="5" <?php if($item->penghuni == 5){echo "selected";}?>>Pria dan Wanita</option>
										<option value="6" <?php if($item->penghuni == 6){echo "selected";}?>>Suami istri</option>
									</select><i><u><?php echo form_error('penghuni'); ?></u></i>
								</div>
							</div>
							
							<div class="control-group" id="penghuni_mayoritas">
								<label class="control-label"><b>Mayoritas penghuni:</b></label>
								<div class="controls docs-input-sizes">
									<select name="penghuni_mayoritas"  size="1" class="span3">
										<option value="" <?php if($item->penghuni_mayoritas == null){echo "selected";}?>>Pilih</option>
										<option value="1" <?php if($item->penghuni_mayoritas == 1){echo "selected";}?>>Mahasiswa/pelajar</option>
										<option value="2" <?php if($item->penghuni_mayoritas == 2){echo "selected";}?>>Keluarga</option>
										<option value="3" <?php if($item->penghuni_mayoritas == 3){echo "selected";}?>>Karyawan</option>
										<option value="4" <?php if($item->penghuni_mayoritas == 4){echo "selected";}?>>Karyawati</option>
									</select><i><u><?php echo form_error('penghuni_mayoritas'); ?></u></i>
								</div>
							</div>
							
							<div class="control-group" id="dekat_dgn">
								<label class="control-label"><b>Dekat dengan:</b></label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span4" name="dekat_dgn"  style="resize:none;"><?php echo $item->dekat_dgn;?></textarea><i><?php echo form_error('dekat_dgn'); ?></i>
								</div>
							</div>
							
							<div class="control-group" id="with_owner">
								<label class="control-label" style="margin-top:-12px"><b>1 rumah dengan pemilik kost:</b></label>
								<div class="controls docs-input-sizes">
									<select name="with_owner" size="1" class="span1">
										<option value="1" <?php if($item->with_owner == "Ya"){echo "selected";}?>>Ya</option>
										<option value="2" <?php if($item->with_owner == "Tidak"){echo "selected";}?>>Tidak</option>
									</select><i><u><?php echo form_error('with_owner'); ?></u></i>
								</div>
							</div>
							
							<div class="page-header" id="page-header" style="margin-top:10px">
								<h1><small>Fasilitas Lokasi</small></h1>
							</div>
							<div id="detail_wrapper">
								<?php foreach($fasilitas_lokasi as $row):?>
									<div style="width:33.333%;float:left">
										<label class="checkbox">
											<input type="checkbox" name="keamanan" id="keamanan" value="1" <?php if($row->keamanan == 1){echo "checked";} ?> /> Keamanan
										</label>
										<label class="checkbox">
											<input type="checkbox" name="banjir" id="banjir" value="1" <?php if($row->banjir == 1){echo "checked";} ?> /> Aman banjir
										</label>
										<label class="checkbox">
											<input type="checkbox" name="univ" id="univ" value="1" <?php if($row->univ == 1){echo "checked";} ?> /> Dekat universitas
										</label>
									</div>
									<div style="width:33.333%;float:left">
										<label class="checkbox">
											<input type="checkbox" name="pasar" id="pasar" value="1" <?php if($row->pasar == 1){echo "checked";} ?> /> Dekat pasar
										</label>
										<label class="checkbox">
											<input type="checkbox" name="kendaraan" id="kendaraan" value="1" <?php if($row->kendaraan == 1){echo "checked";} ?> /> Jalur kendaraan umum
										</label>
									</div>
									<div style="width:33.333%;float:left">
										<label class="checkbox">
											<input type="checkbox" name="sekolah" id="sekolah" value="1" <?php if($row->sekolah == 1){echo "checked";} ?> /> Dekat sekolah
										</label>
										<label class="checkbox">
											<input type="checkbox" name="toko" id="toko" value="1" <?php if($row->toko == 1){echo "checked";} ?> /> Dekat pertokoan / mall
										</label>
									</div>
								<?php endforeach; ?>
							</div>
							
							<div class="page-header" id="page-header" style="margin-top:10px">
								<h1><small>Fasilitas Kamar</small></h1>
							</div>
							<div id="detail_wrapper">
								<?php foreach($fasilitas_kamar as $row):?>
								<div style="width:33.333%;float:left">
									<label class="checkbox">
										<input type="checkbox" name="kmr_ac" id="kmr_ac" value="1" <?php if ($row->kmr_ac == 1){echo "checked";} ?> /> AC
									</label>
									<label class="checkbox">
										<input type="checkbox" name="kipas" id="kipas" value="1" <?php if($row->kipas == 1){echo "checked";} ?> /> Kipas angin
									</label>
									<label class="checkbox">
										<input type="checkbox" name="meja" id="meja" value="1" <?php if($row->meja == 1){echo "checked";} ?> /> Meja/kursi
									</label>
									<label class="checkbox">
										<input type="checkbox" name="rakbuku" id="rakbuku" value="1" <?php if($row->rakbuku == 1){echo "checked";} ?> /> Rak buku
									</label>
								</div>
								
								<div style="width:33.333%;float:left">
									<label class="checkbox">
										<input type="checkbox" name="tvcable" id="tvcable" value="1" <?php if($row->tvcable == 1){echo "checked";} ?> /> TV Cable
									</label>
									<label class="checkbox">
										<input type="checkbox" name="shower" id="shower" value="1" <?php if($row->shower == 1){echo "checked";} ?> /> Shower(hot & cold)
									</label>
									<label class="checkbox">
										<input type="checkbox" name="telkamar" id="telkamar" value="1" <?php if($row->telkamar == 1){echo "checked";} ?> /> Telepon kamar
									</label>
									<label class="checkbox">
										<input type="checkbox" name="tmptidur" id="tmptidur" value="1" <?php if($row->tmptidur == 1){echo "checked";} ?> /> Tempat tidur
									</label>
								</div>
								 
								<div style="width:33.333%;float:left">
									<label class="checkbox">
										<input type="checkbox" name="lemari" id="lemari" value="1" <?php if($row->lemari == 1){echo "checked";} ?> /> Lemari pakaian
									</label>
									<label class="checkbox">
										<input type="checkbox" name="lcd" id="lcd" value="1" <?php if($row->lcd == 1){echo "checked";} ?> /> LCD / TV
									</label>
									<label class="checkbox">
										<input type="checkbox" name="mandidlm" id="mandidlm" value="1" <?php if($row->mandidlm == 1){echo "checked";} ?> /> Kamar mandi di dalam
									</label>
								</div>
								<?php endforeach; ?>
							</div>
							
							<div class="page-header" id="page-header" style="margin-top:10px">
								<h1><small>Fasilitas Kost</small></h1>
							</div>
							<div id="detail_wrapper">
								<?php foreach($fasilitas_kost as $row):?>
								<div style="width:33.333%;float:left">
									<label class="checkbox">
										<input type="checkbox" name="dapur" id="dapur" value="1" <?php if($row->dapur == 1){echo "checked";} ?> /> Dapur
									</label>
									<label class="checkbox">
										<input type="checkbox" name="catering" id="catering" value="1" <?php if($row->catering == 1){echo "checked";} ?> /> Catering
									</label>
									<label class="checkbox">
										<input type="checkbox" name="internet" id="internet" value="1" <?php if($row->internet == 1){echo "checked";} ?> /> Internet
									</label>
									<label class="checkbox">
										<input type="checkbox" name="rtamu" id="rtamu" value="1" <?php if($row->rtamu == 1){echo "checked";} ?> /> Ruang Tamu
									</label>
								</div>
								
								<div style="width:33.333%;float:left">
									<label class="checkbox">
										<input type="checkbox" name="parkiran" id="parkiran" value="1" <?php if($row->parkiran == 1){echo "checked";} ?> /> Parkir
									</label>
									<label class="checkbox">
										<input type="checkbox" name="jammalam" id="jammalam" value="1" <?php if($row->jammalam == 1){echo "checked";} ?> /> Batas Jam malam / berkunjung
									</label>
									<label class="checkbox">
										<input type="checkbox" name="cctv" id="cctv" value="1" <?php if($row->cctv == 1){echo "checked";} ?> /> CCTV
									</label>
								</div>
								
								<div style="width:33.333%;float:left">
									<label class="checkbox">
										<input type="checkbox" name="prt" id="prt" value="1" <?php if($row->prt == 1){echo "checked";} ?> /> Pembantu rumah tangga
									</label>
									<label class="checkbox">
										<input type="checkbox" name="olhraga" id="olhraga" value="1" <?php if($row->olhraga == 1){echo "checked";} ?> /> Fasilitas Olahraga
									</label>
									<label class="checkbox">
										<input type="checkbox" name="cucisetrika" id="cucisetrika" value="1" <?php if($row->cucisetrika == 1){echo "checked";} ?> /> Cuci & Setrika
									</label>
								 </div>
								<?php endforeach; ?>
							</div>
							
							<div class="page-header" id="page-header" style="margin:10px 0 10px 0;">
								<h1><small>Foto</small></h1> <span class="label" style="float:right;margin:-30px 0 0 0px;padding:4px;"><?php echo anchor("#add_photo","Tambah Gambar Listing",array("data-toggle"=>"modal","style"=>"color:#fff;outline:none;")); ?></span>
							</div>
							<div id="detail_wrapper">
							
							(*anda dapat mengupload 7 foto untuk paket premium, dan 3 foto untuk paket gratis.) <br/>
							
							<?php foreach($paket_listing as $row): ?>
							
								<?php $x = 0; ?>
								<?php $paket = $row->status_paket; ?>
								
								<?php foreach($listing_photo as $cover): ?>
								<div id="photo_wrapper">
									<?php if($row->status_paket == 1){ ?>
										<a href="<?php echo base_url(); ?>file/img/free/<?php echo $cover->listing_photo_big;?>" rel="facebox"><img src="<?php echo base_url(); ?>file/img/free/thumb/<?php echo $cover->listing_photo_thumb; ?>" class="thumbnail" align="left" style="margin-right : 9px;" width="148px" /></a>
									<?php } else {?>
										<a href="<?php echo base_url(); ?>file/img/premium/<?php echo $cover->listing_photo_big;?>" rel="facebox"><img src="<?php echo base_url(); ?>file/img/premium/thumb/<?php echo $cover->listing_photo_thumb; ?>" class="thumbnail" align="left" style="margin-right : 9px;" width="148px" /></a>
									<?php } $x++; ?>
									<?php echo anchor("#delete_confirm","<i class='icon icon-remove'></i>",array("class"=>"photobtn","title"=>"Hapus foto","data-toggle"=>"modal")); ?>
									<?php 
									$dumb = 0;
									foreach($listing_cover as $c):
										$dumb = $c->id_listing_photo;
									endforeach; 
									if($dumb == $cover->id_listing_photo){
										echo anchor("#cover_info","<img src=".base_url()."file/img/cover_badge.png />",array("class"=>"photobtn3","data-toggle"=>"modal","title"=>"Foto ini adalah cover foto listing anda."));
									}
									else{
										echo anchor("member_listing/edit_listing_cover/".$cover->id_listing_photo,"<i class='icon icon-tag'></i>",array("class"=>"photobtn2","title"=>"Jadikan foto cover listing"));
									}
									$idphoto = $cover->id_listing_photo;
									?>
								</div>
								<?php endforeach; ?>
								
							<?php endforeach; ?>
							
							</div>
							
							<div class="page-header" id="page-header" style="margin-top:10px">
								<h1><small></small></h1>
							</div>
							
							<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
								<button type="submit" class="btn btn-primary btn-large">Edit Listing</button>
								<button type="submit" class="btn btn-large">Cancel</button>
							</div>
						</fieldset>
						<?php echo form_close(); ?>
						<?php endforeach; ?>
					</div>
					
					<!------ MODAL BUAT KONFIRMASI HAPUS PHOTO ------>
					<div id="delete_confirm" class="modal hide fade" style="display:none;">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Konfirmasi</h3>
						</div>	
						<div class="modal-body">
							Anda yakin ingin menghapus foto ini ?
						</div>
						<div class="modal-footer">
							<?php echo anchor("member_listing/delete_listing_photo/".$idphoto,"hapus Foto",array("class"=>"btn btn-primary")); ?>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
					</div>
					
					<!------ MODAL BUAT INFORMASI TENTANG COVER FOTO LISTING ------>
					<div id="cover_info" class="modal hide fade" style="display:none;">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Cover Listing</h3>
						</div>	
						<div class="modal-body">
							Cover listing adalah foto yang akan ditampilkan sebagai foto utama pada iklan anda jika pengunjung lain sedang mencari/melihat iklan anda.
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
							<?php echo form_close(); ?>
						</div>
					</div>
					
					<!------ MODAL BUAT TAMBAH FOTO ------>
					<div id="add_photo" class="modal hide fade" style="display:none;">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Tambah Gambar Listing</h3>
						</div>
						<?php 
							$batas = $paket == 1 ? 3 : 7 ;
							if($x < $batas){
						?>
						<div class="modal-body">
								<?php foreach($listing as $item):?>
									<?php $pk = $item->id_listing_member; ?>
								<?php endforeach; ?>
								<?php echo form_open_multipart("member_listing/add_listing_photo/".$pk); ?>
								Upload gambar listing : 
								<input class="span3" type="file" name="listing_photo" /> <br/>
								<label class="checkbox">
								<input type="checkbox" name="set_cover" id="set_cover" value="1" /> Jadikan cover listing
								</label>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Tambah Gambar Listing</button>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
						<?php }else{ ?>
						<div class="modal-body">
								Maaf, anda hanya dapat mengupload maksimal <?php echo $batas; ?> gambar.
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
						</div>
						<?php } ?>
					</div>
					
					<script type="text/javascript">
						$('#add_photo').modal(options);
						$('#cover_info').modal(options);
						$('#delete_confirm').modal(options);
					 </script>