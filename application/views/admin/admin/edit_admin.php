				
				
				<div id="cpanel_wrapper">
					<?php foreach($admin_profile as $item): ?>
					<h3>Profil Admin : <?php echo $item->nama; ?></h3>
					<br/><br/><br/>
					<?php endforeach; ?>
					
					<div style="width:100%;float:left;">
					
					<?php if($message != null){ ?>
						<div class='alert alert-info' style="float:left">
							<?php echo $message; ?>
						</div>
					<?php } ?>
					
					<?php 
					foreach($admin_profile as $item): 
						if($item->admin_photo == null){
							$photo = "default_pp.jpg";
						}
						else{
							$photo = $item->admin_photo;
						}
					?>
					
					<fieldset>
					
						<legend>
							Edit Admin
						</legend>
						
						<div style="width:100%;">
						
							<?php echo form_open_multipart("administrator_manager/do_edit/".$item->id_admin,array("class"=>"form-horizontal","name"=>"form")); ?>
							tanda bintang (*) harus diisi. <br/><br/>
							
							<div class="control-group">
								<label class="control-label">Nama : </label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="nama" value="<?php echo $item->nama; ?>"/>*
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Email : </label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="email" value="<?php echo $item->email; ?>"/>*
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Password : </label>
								<div class="controls docs-input-sizes">
									<input class="span2" type="password" name="password" />* masukkan password baru jika ingin diganti
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
									<textarea rows="5" class="field span3" name="alamat" style="resize:none;"><?php echo $item->alamat; ?></textarea>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">No. HP : </label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="hp" value=""/>
								</div>
							</div>
						
						</div>
						
						<br/><br/>
							
						<div class="modal-footer">
								<button type="submit" class="btn btn-primary btn-large">Edit</button>
								<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
								<?php echo form_close(); ?>
						</div>
					
					</fieldset>
					
					<?php endforeach; ?>
					
					</div>
					
				</div>
					
			</div>