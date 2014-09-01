				
				
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
					
					</div>
					
					<?php 
					foreach($admin_profile as $item): 
						if($item->admin_photo == null){
							$photo = "default_pp.jpg";
						}
						else{
							$photo = $item->admin_photo;
						}
					?>
					<img src="<?php echo base_url(); ?>file/img/admin/<?php echo $photo; ?>" align="left" class="img-polaroid" style="margin-right : 10px;">
					
					<fieldset>
					
						<script LANGUAGE="JavaScript">
							function confirmDelete(){
								var agree=confirm("Anda yakin ingin menghapus admin ini ?");
								if (agree)
									return true ;
								else
									return false ;
							}
						</script>
					
						<legend>
							<?php echo $item->nama; ?>
						</legend>
						<blockquote>
						  <p><?php echo $item->alamat; ?></p>
						  <small><i class="icon-envelope"></i>  <?php echo $item->email; ?></small>
						  <small><i class="icon-star"></i>  <?php echo "HP: ".$item->hp; ?></small>
						  <small><i class="icon-user"></i>  <?php echo "Level :".($item->level == 1 ? "Super Administrator" : "Administrator"); ?></small>
						</blockquote>
						<?php //echo anchor("member/edit_profile","Edit Profile",array("class"=>"btn btn-small","style"=>"margin-top : -20px;")) ?>
					
						<br/><br/>
							
						<div class="modal-footer">
							<?php echo anchor("administrator_manager/edit/".$item->id_admin,"Edit",array("class"=>"btn btn-large btn-primary","style"=>"float:left;")); ?>
							<?php echo anchor("administrator_manager/delete/".$item->id_admin,"Hapus",array("class"=>"btn btn-large btn-primary","style"=>"float:left;","onClick"=>"return confirmDelete()")); ?>
						</div>
					
					</fieldset>
					
					<?php endforeach; ?>
					
					</div>
					
				</div>
					
			</div>