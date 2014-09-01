				
				
				<div id="cpanel_wrapper">
					<?php foreach($member_profile as $item): ?>
					<h3>Profil user : <?php echo $item->nama; ?></h3>
					<?php endforeach; ?>
					
					<div class="navbar" style="float:left;width:100%;margin-top:20px;">
					  <div class="navbar-inner">
						<form class="navbar-form pull-left">
						  <input type="text" class="span3">
						  <button type="submit" class="btn">Cari Member</button>
						</form>
					  </div>
					</div>
					
					<div style="width:100%;float:left;">
					
					<?php if($message != null){ ?>
						<div class='alert alert-info' style="float:left">
							<?php echo $message; ?>
						</div>
					<?php } ?>
					
					<?php 
					foreach($member_profile as $item): 
						if($item->user_photo == null){
							$photo = "default_pp.jpg";
						}
						else{
							$photo = $item->user_photo;
						}
					?>
					<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $photo; ?>" align="left" class="img-polaroid" style="margin-right : 10px;">
					
					<fieldset>
					
						<script LANGUAGE="JavaScript">
							function confirmDelete(){
								var agree=confirm("Anda yakin ingin menghapus member ini ?");
								if (agree)
									return true ;
								else
									return false ;
							}
						</script>
					
						<legend>
							<?php echo $item->nama; ?>
							<?php echo anchor("member_manager/delete/".$item->id_user,"Hapus",array("class"=>"label","onClick"=>"return confirmDelete()")); ?>
							<?php echo anchor("member_manager/edit/".$item->id_user,"Edit",array("class"=>"label")); ?>
							<?php echo anchor("member_manager/see_listing/".$item->id_user,"Lihat Daftar Iklan",array("class"=>"label")); ?> <br/>
						</legend>
						<blockquote>
						  <p><?php echo $item->alamat.", ".ucfirst(strtolower($item->kab)).", ".ucfirst(strtolower($item->provinsi))."."; ?></p>
						  <small><i class="icon-user"></i>  <?php echo "mendaftar sebagai : ".$item->register_as; ?></small>
						  <small><i class="icon-envelope"></i>  <?php echo $item->email; ?></small>
						</blockquote>
						<?php //echo anchor("member/edit_profile","Edit Profile",array("class"=>"btn btn-small","style"=>"margin-top : -20px;")) ?>
					</fieldset>
					
					<hr/>
					
					<div style="width:100%;float:left;line-height:30px;">
						<b>Jenis Kelamin : </b><?php echo($item->jk == "men" ? "laki-laki" : "prempuan"); ?><br/>
						<b>No. Handphone : </b><?php echo ($item->hp == null ? "-" : $item->hp); ?><br/>
						<b>No. Telepon : </b><?php echo ($item->telepon == null ? "-" : $item->telepon); ?><br/>
						<b>Fax : </b><?php echo ($item->fax == null ? "-" : $item->fax); ?><br/>
						<b>Provinsi : </b><?php echo ($item->provinsi == null ? "-" : ucfirst(strtolower($item->provinsi))); ?><br/>
						<b>Kabupaten : </b><?php echo ($item->kab == null ? "-" : ucfirst(strtolower($item->kab))); ?><br/>
					</div>
					
					<?php endforeach; ?>
					
					</div>
					
				</div>
					
			</div>