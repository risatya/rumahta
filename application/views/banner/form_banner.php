
					<div id="inside_main_wrapper">
						
						<?php if($message != null){ ?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						<?php echo form_open_multipart("member_banner/save_banner/".$posisi_banner,array("class"=>"form-horizontal","name"=>"form")); ?>
						<fieldset>
							<legend>Pesan Iklan banner<small> | Field dengan tanda bintang(*) harus diisi.</small></legend>
							
							<div class="control-group">
								<label class="control-label">Jenis Banner:</label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" readonly="yes" value="<?php echo ($posisi_banner == 1 ? "Banner atas" : ($posisi_banner == 2 ? "Banner kanan" : ($posisi_banner == 3 ? "Banner bawah" : ""))); ?>" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Posisi banner:</label>
								<div class="controls docs-input-sizes">
									<select name="posisi"  size="1" class="span3">
										<?php if($posisi_banner == 1){ ?>
											<?php if($banner['top1']['pic'] == "top_default.jpg"){echo "<option value='1'>Banner atas 1</option>";} ?>
										<?php }else if($posisi_banner == 2){ ?>
											<?php if($banner['side1']['pic'] == "side_default.jpg"){echo "<option value='2'>Banner kanan 1 (paling atas)</option>";} ?>
											<?php if($banner['side2']['pic'] == "side_default.jpg"){echo "<option value='3'>Banner kanan 2</option>";} ?>
											<?php if($banner['side3']['pic'] == "side_default.jpg"){echo "<option value='4'>Banner kanan 3</option>";} ?>
											<?php if($banner['side4']['pic'] == "side_default.jpg"){echo "<option value='5'>Banner kanan 4</option>";} ?>
											<?php if($banner['side5']['pic'] == "side_default.jpg"){echo "<option value='6'>Banner kanan 5 (paling bawah)</option>";} ?>
										<?php }else if($posisi_banner == 3){ ?>
											<?php if($banner['bottom1']['pic'] == "bottom_default.jpg"){echo "<option value='7'>Banner bawah 1 (sebelah kiri)</option>";} ?>
											<?php if($banner['bottom2']['pic'] == "bottom_default.jpg"){echo "<option value='8'>Banner bawah 2 (sebelah kanan)</option>";} ?>
										<?php }else{ ?>
										
										<?php } ?>
									</select> *
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Durasi:</label>
								<div class="controls docs-input-sizes">
									<select name="durasi"  size="1" class="span3">
										<?php foreach($harga as $item):  ?>
											<option value="<?php echo $item->id_harga; ?>"><?php echo $item->durasi." Bulan (Rp. ".number_format($item->harga,0,",",".").")"; ?></option>
										<?php endforeach;?>
									</select> *
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
							
							<div class="control-group">
								<label class="control-label">Gambar Banner:</label>
								<div class="controls">
									 <div class="input-prepend">
										<input type="file" name="banner_photo" class="span3" />
									 </div>
									<p class="block">
									<?php 
										//get banner_width...
										$banner_width = ($posisi_banner == 1 ? 560 : ($posisi_banner == 2 ? 200 : ($posisi_banner == 3 ? 455 : "")));
										//get banner height..
										$banner_height = ($posisi_banner == 1 ? 165 : ($posisi_banner == 2 ? 160 : ($posisi_banner == 3 ? 120 : ""))); 
										echo "*<small>File yang diijinkan hanya gif, jpg dan png. <br/>Rekomendasi ukuran foto adalah ".$banner_width." x ".$banner_height." px. Jika tidak sesuai dengan ukuran diatas, sistem kami akan merubah ukuran gambar anda secara otomatis.</small>";
									?>
									</p>
								</div>
							</div>
							
							<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
								<button type="submit" class="btn btn-primary btn-large">Pesan Banner</button>
								<button class="btn btn-large">Cancel</button>
							</div>
							
						</fieldset>
					</div>
				