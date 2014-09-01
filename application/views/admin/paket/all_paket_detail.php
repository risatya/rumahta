
							<div style="float:left;widht:100%:">
								<?php echo anchor("#new_paket","Buat Paket Harga Baru",array("style"=>"outline:none;","class"=>"btn btn-large btn-primary","data-toggle"=>"modal")); ?>
							</div>
							
							<br/><br/>
							
							<table class="table table-bordered table-stripped" style="margin-top:10px;">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="30%">Posisi Paket</th>
										<th width="30%">Durasi (Bulan)</th>
										<th width="22%">Harga</th>
										<th width="13%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($paket_detail as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo ($item->posisi == 1 ? "Top Banner(Atas)" : ($item->posisi == 2 ? "Side Banner(Samping)" : "Bottom Banner(Bawah)")); ?></td>
											<td><?php echo $item->durasi." Bulan"; ?></td>
											<td><?php echo "Rp. ".number_format($item->harga,0,",","."); ?></td>
											<td>
												<?php echo anchor("#edit".$item->id_harga,"<i class='icon icon-edit'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Paket","data-toggle"=>"modal")); ?>
												<?php echo anchor("#delete".$item->id_harga,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Nonaktifkan Paket Paket","data-toggle"=>"modal")); ?>
											</td>
										</tr>
									<?php 
									$no++;
									endforeach; ?>
								</tbody>
							</table>
					
				</div>
			
			</div>
			
			<script type="text/javascript">
				<?php foreach($all_paket as $item): ?>
					$('#edit<?php echo $item->harga; ?>').modal(options);
					$('#delete<?php echo $item->harga; ?>').modal(options);
				<?php endforeach;?>
			</script>
			
			<?php foreach($paket_detail as $item): ?>
				<div id="delete<?php echo $item->id_harga; ?>" class="modal hide fade">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">×</button>
					  <h3>Hapus Harga Paket</h3>
					</div>
					<div class="modal-body">
						Anda Yakin ingin menonaktifkan paket ini ? <br/><br/>
					</div>
					<div class="modal-footer">
						<?php echo anchor("paket_banner_manager/delete_harga_paket/".$item->id_harga,"Hapus Harga Paket",array("class"=>"btn btn-primary btn-large")); ?>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
			
			<?php foreach($paket_detail as $item): ?>
				<div id="edit<?php echo $item->id_harga; ?>" class="modal hide fade">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">×</button>
					  <h3>Edit Harga Paket</h3>
					</div>
					<div class="modal-body">
						<?php echo form_open("paket_banner_manager/edit_harga_paket/".$item->id_harga,array("class"=>"form-horizontal","name"=>"form")); ?>
						
						tanda bintang (*) harus diisi. <br/><br/>
						
						<div class="control-group">
							<label class="control-label">Posisi Paket : </label>
							<div class="controls docs-input-sizes">
								<input class="span2" type="text" readonly="yes" name="posisi_paket" value="<?php echo $item->posisi; ?>"/>* <?php echo ($item->posisi == 1 ? "Top Banner(Atas)" : ($item->posisi == 2 ? "Side Banner(Samping)" : "Bottom Banner(Bawah)")); ?>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Harga : </label>
							<div class="controls docs-input-sizes">
								<div class="input-prepend">
									<span class="add-on">Rp. </span><input class="span2" id="prependedInput" name="harga" value="<?php echo $item->harga; ?>" size="3" type="text" />
								 </div>*
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Durasi : </label>
							<div class="controls docs-input-sizes">
								<div class="input-append">
								  <input class="span1" name="durasi" value="<?php echo $item->durasi; ?>" id="appendedInput" size="16" type="text"><span class="add-on">Bulan</span>
								</div>*
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-large">Edit Harga Paket</button>
						<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
			
			<div id="new_paket" class="modal hide fade">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">×</button>
				  <h3>Buat Paket Harga Baru</h3>
				</div>
				<div class="modal-body">
				
					<?php echo form_open("paket_banner_manager/new_harga_paket",array("class"=>"form-horizontal","name"=>"form")); ?>
					tanda bintang (*) harus diisi. <br/><br/>
					
					<div class="control-group">
						<label class="control-label">Posisi Paket : </label>
						<div class="controls docs-input-sizes">
							<select name="posisi_paket">
								<option value="1">Top Banner (atas)</option>
								<option value="2">Side Banner (samping)</option>
								<option value="3">Bottom Banner(bawah)</option>
							</select>*
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Harga : </label>
						<div class="controls docs-input-sizes">
							<div class="input-prepend">
								<span class="add-on">Rp. </span><input class="span2" id="prependedInput" name="harga" size="3" type="text" />
							</div>*
							<p class="help-block">Isikan hanya dengan angka.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Durasi : </label>
						<div class="controls docs-input-sizes">
							<div class="input-append">
							  <input class="span1" name="durasi"  id="appendedInput" size="16" type="text"><span class="add-on">Bulan</span>
							</div>*
							<p class="help-block">Isikan hanya dengan angka.</p>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-large">Buat Paket Baru</button>
					<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
					<?php echo form_close(); ?>
				</div>
			</div>