				
				
				<div id="cpanel_wrapper">
						
					<h3>Member Manager</h3>
					
					<div class="navbar" style="float:left;width:100%;margin-top:20px;">
					  <div class="navbar-inner">
						<?php echo form_open("member_manager/search_member",array('class'=>'navbar-form pull-left')); ?>
						  <input type="text" class="span3" name="keyword" placeholder="Masukan Username Member">
						  <button type="submit" class="btn">Cari Member</button>
						<?php echo form_close(); ?>
					  </div>
					</div>
					
					<?php if($message != null){ ?>
						<div class='alert alert-info' style="float:left">
							<?php echo $message; ?>
						</div>
					<?php } ?>
					
					<table class="table table-bordered table-stripped" style="float:left;">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="45%" colspan="2">Nama Member</th>
								<th width="25%">Username</th>
								<th width="25%">Aksi</th>
							</tr>
						</thead>
						
						<script LANGUAGE="JavaScript">
							function confirmDelete(){
								var agree=confirm("Anda yakin ingin menghapus member ini ?");
								if (agree)
									return true ;
								else
									return false ;
							}
						</script>
						
						<tbody>
							<?php $x = 1; ?>
							<?php foreach($all_member as $item): ?>
							<tr>
								<td><?php echo $x; ?></td>
								<td><img src="<?php echo base_url(); ?>file/img/pp/<?php echo ($item->user_photo == null || $item->user_photo == "" ? "default_pp.jpg" : $item->user_photo); ?>" width="20px" class="thumbnail" ></td>
								<td><?php echo anchor("member_manager/member_detail/".$item->id_user,$item->nama); ?></td>
								<td><?php echo anchor("member_manager/member_detail/".$item->id_user,$item->username); ?></td>
								<td>
									<?php echo anchor("member_manager/edit/".$item->id_user,"<i class='icon icon-pencil'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Profil Member")) ?>
									<?php echo anchor("member_manager/delete/".$item->id_user,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Hapus Member","onClick"=>"return confirmDelete()")) ?>
									<?php //echo anchor("member_manager/banned/".$item->id_user,"<i class='icon icon-ban-circle'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Banned / Blokir Member")) ?>
									<?php echo anchor("member_manager/see_listing/".$item->id_user,"<i class='icon icon-tag'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Lihat Listing Member")) ?>
								</td>
							</tr>
							<?php $x++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					<p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p>
					
				</div>
					
			</div>