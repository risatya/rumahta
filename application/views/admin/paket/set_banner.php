
						
						<?php echo form_open_multipart("paket_banner_manager/do_set_banner/".$id_info_banner,array("class"=>"form-horizontal","name"=>"form")); ?>
						
						<fieldset>
							<legend>Pesan Iklan banner<small> | Field dengan tanda bintang(*) harus diisi.</small></legend>
							
							<div class="control-group">
								<label class="control-label">Jenis Banner:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" readonly="yes" value="<?php echo ($posisi_banner == 1 ? "Banner atas" : ($posisi_banner == 2 ? "Banner kanan" : ($posisi_banner == 3 ? "Banner bawah" : ""))); ?>" />
								</div>
							</div>
							<!--
							<div class="control-group">
								<label class="control-label">Posisi banner:</label>
								<div class="controls docs-input-sizes">
									<select name="posisi"  size="1" class="span3">
										<?php //echo "<option value='1'>Banner atas 1</option>"; ?>
										<?php// echo "<option value='2'>Banner kanan 1 (paling atas)</option>"; ?>
										<?php //echo "<option value='3'>Banner kanan 2</option>"; ?>
										<?php// echo "<option value='4'>Banner kanan 3</option>"; ?>
										<?php //echo "<option value='5'>Banner kanan 4</option>"; ?>
										<?php //echo "<option value='6'>Banner kanan 5 (paling bawah)</option>"; ?>
										<?php// echo "<option value='7'>Banner bawah 1 (sebelah kiri)</option>"; ?>
										<?php// echo "<option value='8'>Banner bawah 2 (sebelah kanan)</option>"; ?>
									</select> *
								</div>
							</div>-->
							
							<!--<div class="control-group">
								<label class="control-label">Durasi:</label>
								<div class="controls docs-input-sizes">
									<select name="durasi"  size="1" class="span3">
											<option value="3">3 Bulan</option>
											<option value="6">6 Bulan</option>
											<option value="12">12 Bulan</option>
									</select> *
								</div>
							</div>-->
							
							<div class="control-group">
								<label class="control-label">Durasi:</label>
								<div class="controls">
									 <div class="input-append">
										<input class="span1" type="text" name="durasi" placeholder="3" value="" />
										<span class="add-on">Bulan</span>
									</div>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">URL website:</label>
								<div class="controls">
									 <div class="input-prepend">
										<span class="add-on">Http://</span>
										<input class="span3" type="text" name="url" placeholder="www.example.com" value="<?php echo set_value('url'); ?>" />
									 </div>
								</div>
							</div>
							
							<!--<script src="<?php //echo base_url();?>file/js/jquery.ui.autocomplete.js"></script>-->
							
							<style>
							.ui-autocomplete {
								position : absolute;
								max-height: 200px;
								width :100px; 
								overflow-y: scroll;
								overflow-x: hidden;
								padding-right: 20px;
								border : 3px solid #f1f1f1;
								background : #fff;
							}
							.ui-autocomplete ul{
								list-style : none;
							}
							.ui-autocomplete li{
								padding : 5px 0 5px 0;
							}
							.ui-autocomplete a{
								padding : 6px 300px 6px 20px;
							}
							.ui-autocomplete a:hover{
								background : #f1f1f1;
								text-decoration : none;
							}
							* html .ui-autocomplete {
								height: 100px;
								width :100px; 
							}
							</style>
							<script>
							$(function() {
								var availableTags = [
									<?php foreach($userlist as $item): 
										echo '"'.$item->username.'",';
									endforeach; ?>
								];
								$( "#tags" ).autocomplete({
									source: availableTags
								});
							});
							</script>
							
							<div class="control-group">
								<label class="control-label">Username pemasang:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" id="tags" name="username" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Gambar Banner:</label>
								<div class="controls">
									 <div class="input-prepend">
										<input type="file" name="banner_photo" class="span3" />
									 </div>
									<p class="block">
									<?php 
										//get banner_width...
										$banner_width = ($posisi_banner == 1 ? 562 : ($posisi_banner == 2 ? 202 : ($posisi_banner == 3 ? 456 : "")));
										//get banner height..
										$banner_height = ($posisi_banner == 1 ? 165 : ($posisi_banner == 2 ? 164 : ($posisi_banner == 3 ? 122 : ""))); 
										echo "*<small>rekomendasi ukuran foto adalah ".$banner_width." x ".$banner_height." px. Jika tidak sesuai dengan ukuran diatas, sistem kami akan merubah ukuran gambar anbda secara otomatis.</small>";
									?>
									</p>
								</div>
							</div>
							
							<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
								<button type="submit" class="btn btn-primary btn-large">Pesan Banner</button>
								<button class="btn btn-large">Cancel</button>
							</div>
							
						</fieldset>
						
						<?php echo form_close(); ?>
						
				</div>
			
			</div>