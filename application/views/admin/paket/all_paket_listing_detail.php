
							<div style="float:left;widht:100%:">
								<?php echo anchor("#new_paket","Buat Paket Baru",array("style"=>"outline:none;","class"=>"btn btn-large btn-primary","data-toggle"=>"modal")); ?>
							</div>
							
							<br/><br/>
							
							<table class="table table-bordered table-stripped" style="margin-top:10px;">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="30%">Nama Paket</th>
										<th width="22%">Harga</th>
										<th width="12%">Quota Listing</th>
										<th width="20%">Durasi (bulan)</th>
										<th width="13%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($all_paket as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $item->nama_paket; ?></td>
											<td><?php echo "Rp. ".number_format($item->harga,0,",","."); ?></td>
											<td><?php echo $item->maks_listing; ?></td>
											<td><?php echo $item->durasi_listing." bulan"; ?></td>
											<td>
												<?php echo anchor("#edit".$item->id_info_paket,"<i class='icon icon-edit'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Paket","data-toggle"=>"modal")); ?>
												<?php echo anchor("#delete".$item->id_info_paket,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Nonaktifkan Paket Paket","data-toggle"=>"modal")); ?>
											</td>
										</tr>
									<?php 
									$no++;
									endforeach; ?>
								</tbody>
							</table>
							
						<p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p>
					
				</div>
			
			</div>
			
			<script type="text/javascript">
				<?php foreach($all_paket as $item): ?>
					$('#edit<?php echo $item->id_info_paket; ?>').modal(options);
					$('#delete<?php echo $item->id_info_paket; ?>').modal(options);
				<?php endforeach;?>
			</script>
			
			<?php foreach($all_paket as $item): ?>
				<div id="delete<?php echo $item->id_info_paket; ?>" class="modal hide fade">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">×</button>
					  <h3>Hapus Paket</h3>
					</div>
					<div class="modal-body">
						Anda Yakin ingin menonaktifkan paket ini ? <br/><br/>
					</div>
					<div class="modal-footer">
						<?php echo anchor("paket_listing_manager/delete/".$item->id_info_paket,"Hapus Paket",array("class"=>"btn btn-primary btn-large")); ?>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
			
			<?php foreach($all_paket as $item): ?>
				<div id="edit<?php echo $item->id_info_paket; ?>" class="modal hide fade">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">×</button>
					  <h3>Edit Paket</h3>
					</div>
					<div class="modal-body">
						<?php echo form_open("paket_listing_manager/edit/".$item->id_info_paket,array("class"=>"form-horizontal","name"=>"form")); ?>
						
						tanda bintang (*) harus diisi. <br/><br/>
						
						<div class="control-group">
							<label class="control-label">Nama Paket : </label>
							<div class="controls docs-input-sizes">
								<input class="span2" type="text" name="nama_paket" value="<?php echo $item->nama_paket; ?>"/>*
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
							<label class="control-label">Quota Listing : </label>
							<div class="controls docs-input-sizes">
								<input class="span2" type="text" name="quota" value="<?php echo $item->maks_listing; ?>"/>*
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Durasi : </label>
							<div class="controls docs-input-sizes">
								<div class="input-append">
								  <input class="span2" name="durasi" value="<?php echo $item->durasi_listing; ?>" id="appendedInput" size="16" type="text"><span class="add-on">Bulan</span>
								</div>*
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-large">Edit Paket</button>
						<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
			
			<div id="new_paket" class="modal hide fade">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">×</button>
				  <h3>Buat Paket Baru</h3>
				</div>
				<div class="modal-body">
				
					<?php echo form_open("paket_listing_manager/new_paket",array("class"=>"form-horizontal","name"=>"form")); ?>
					tanda bintang (*) harus diisi. <br/><br/>
					
					<div class="control-group">
						<label class="control-label">Nama Paket : </label>
						<div class="controls docs-input-sizes">
							<input class="span2" type="text" name="nama_paket" />*
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
						<label class="control-label">Quota Listing : </label>
						<div class="controls docs-input-sizes">
							<input class="span2" type="text" name="quota" />*
							<p class="help-block">Isikan hanya dengan angka.</p>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Durasi : </label>
						<div class="controls docs-input-sizes">
							<div class="input-append">
							  <input class="span2" name="durasi"  id="appendedInput" size="16" type="text"><span class="add-on">Bulan</span>
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