			<div id="cpanel_wrapper">
						
				<div style="width:100%;float:left;margin-top:20px">
				
						<fieldset>
							
							<legend>Administrator Manager</legend>
							
							<?php if($message != null){ ?>
								<div class='alert alert-info' style="float:left;width:92%">
									<?php echo $message; ?>
								</div>
							<?php } ?>
							
							<?php
							
								echo anchor("#new_admin","Buat Admin Baru",array("class" => "btn btn-primary btn-large","data-toggle"=>"modal"))."<br/><br/>";
							
							?>
								
							<script LANGUAGE="JavaScript">
								function confirmDelete(){
									var agree=confirm("Anda yakin ingin menghapus admin ini ?");
									if (agree)
										return true ;
									else
										return false ;
								}
							</script>
						
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="20%">Nama Admin</th>
										<th width="40%">Username</th>
										<th width="14%">Status</th>
										<th width="23%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach($admin_list as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $item->nama; ?></td>
											<td><?php echo $item->username; ?></td>
											<td><?php echo ($item->status == 1 ? anchor("administrator_manager/nonactivate/".$item->id_admin,"<span class='label label-success' style='float:left;margin-top:5px'>Aktif</span>",array('title' => 'Nonaktifkan Admin')) : anchor("administrator_manager/activate/".$item->id_admin,"<span class='label label-important' style='float:left;margin-top:5px'>Tidak aktif</span>",array('title' => 'Aktifkan admin'))); ?></td>
											<td><?php 
												
												echo anchor("administrator_manager/admin_detail/".$item->id_admin,"<i class='icon icon-eye-open' style='float:left;margin-top:5px'></i>",array('title' => 'Lihat Detail admin',"class"=>"btn btn-small","style"=>"width:12px;"));
												echo "&nbsp;";
												echo anchor("administrator_manager/edit/".$item->id_admin,"<i class='icon icon-edit' style='float:left;margin-top:5px'></i>",array('title' => 'Edit admin',"class"=>"btn btn-small","style"=>"width:12px;"));
												echo "&nbsp;";
												echo anchor("administrator_manager/delete/".$item->id_admin,"<i class='icon icon-remove' style='float:left;margin-top:5px'></i>",array('title' => 'Hapus admin',"class"=>"btn btn-small","style"=>"width:12px;","onClick"=>"return confirmDelete()"));
												
											?></td>
										</tr>
									<?php $no++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
							
						</fieldset>
					
				</div>
			
			</div>
			
			<script type="text/javascript">
					$('#new_admin').modal(options);
			</script>
			
			<div id="new_admin" class="modal hide fade">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">×</button>
				  <h3>Buat Admin Baru</h3>
				</div>
				<div class="modal-body">
				
					<?php echo form_open_multipart("administrator_manager/new_admin",array("class"=>"form-horizontal","name"=>"form")); ?>
					tanda bintang (*) harus diisi. <br/><br/>
					
					<div class="control-group">
						<label class="control-label">Nama : </label>
						<div class="controls docs-input-sizes">
							<input class="span3" type="text" name="nama" />*
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Username : </label>
						<div class="controls docs-input-sizes">
							<input class="span3" type="text" name="username" />*
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Email : </label>
						<div class="controls docs-input-sizes">
							<input class="span3" type="text" name="email" value="" />*
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Password : </label>
						<div class="controls docs-input-sizes">
							<input class="span2" type="password" name="password" value=""/>*
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Ulangi Password : </label>
						<div class="controls docs-input-sizes">
							<input class="span2" type="password" name="password2"/>*
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Alamat : </label>
						<div class="controls docs-input-sizes">
							<textarea rows="5" class="field span3" name="alamat" style="resize:none;"></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">No. HP : </label>
						<div class="controls docs-input-sizes">
							<input class="span3" type="text" name="hp" />
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Foto Admin : </label>
						<div class="controls docs-input-sizes">
							<input type="file" name="admin_photo" />
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-large">Buat Paket Baru</button>
					<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
					<?php echo form_close(); ?>
				</div>
			</div>