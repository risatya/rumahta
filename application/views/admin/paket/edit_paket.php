				<?php foreach($paket_detail as $item): ?>
					<fieldset>
					
						<legend>
							<?php echo "Edit Paket Member"; ?>
						</legend>
						
						<?php echo form_open("paket_listing_manager/do_edit/".$item->id_paket,array("class"=>"form-horizontal","name"=>"form")); ?>
						
							<div class="control-group">
								<label class="control-label">Nama Member : </label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="nama_member" readonly="yes" value="<?php echo $item->nama; ?>" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Jenis Paket : </label>
								<div class="controls docs-input-sizes">
								  <select name="jenis_paket" size="1">
									<?php foreach($info_paket as $row): ?>
										<option value="<?php echo $row->id_info_paket; ?>" <?php echo($item->id_info_paket == $row->id_info_paket ? "selected" : ""); ?>><?php echo $row->nama_paket; ?></option>
									<?php endforeach; ?>
								  </select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Quota : </label>
								<div class="controls docs-input-sizes">
								  <input class="span1" type="text" name="quota" value="<?php echo $item->quota; ?>" />
								</div>
							</div>
							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
								<button type="button" onclick="history.go(-1)" class="btn">Cancel</button>
							</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
				
				<?php endforeach; ?>
					
				</div>
			
			</div>