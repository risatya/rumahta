
					<div id="cpanel_wrapper">
						
						<h3>Member Manager</h3>
						
						<div class="navbar" style="float:left;width:100%;margin-top:20px;">
						  <div class="navbar-inner">
							<form class="navbar-form pull-left">
							  <input type="text" class="span3">
							  <button type="submit" class="btn">Cari Member</button>
							</form>
						  </div>
						</div>
						
						<div style="width:100%;float:left">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						<!--<div class="well" style="padding-bottom:35px">
							<div style="width:47%;float:left;margin-bottom:10px;">
								<?php// foreach($info_paket as $item): ?>
									<i class="icon icon-th-large"></i> Paket Listing : <span class="label label-success"><?php //echo $item->nama_paket; ?></span><br/>
									<i class="icon icon-tasks"></i> Quota untuk pasang Listing : <span class="label label-success"><?php //echo $item->quota; ?> Listing</span>
								<?php// endforeach; ?>
							</div>
							<div style="width:53%;float:right;">
								<div class="btn-group">
								  <?php //echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
								  <?php //echo anchor("#","<i class='icon icon-arrow-up'></i> Upgrade Paket Listing",array("class"=>"btn")); ?>
								</div>
							</div>
						</div>-->
						
						<?php foreach($listing as $item ):?>
						
						<?php echo form_open("member_manager/do_delete/".$item->id_listing_member."/".$id_user,array("class"=>"form-horizontal","name"=>"form")); ?>
						
						<fieldset>
						
							<div class="page-header" id="page-header">
								<h1><small style="color:#f20000">Anda yakin ingin menghapus Listing ini ?</small></h1>
							</div>
							
							<?php $x = 0; ?>
							<?php foreach($listing_cover as $cover): ?>
								<?php $photoname = $cover->listing_photo_thumb; $x++; ?>
							<?php endforeach; ?>
							<?php if($x == 0){$photoname = "default.jpg"; } ?>
							<?php if($paket == 1){ ?>
								<img src="<?php echo base_url(); ?>file/img/free/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" style="margin-right : 10px;" />
							<?php } else {?>
								<img src="<?php echo base_url(); ?>file/img/premium/thumb/<?php echo $photoname; ?>" class="thumbnail" align="left" style="margin-right : 10px;" />
							<?php } ?>
								
							<p class="listing_detail">
								<span>JUDUL : </span><?php echo $item->judul; ?> <br/>
								<span>KATEGORI : </span><?php echo $item->nama_kategori; ?> <br/>
								<span>HARGA : </span><?php echo $item->harga; ?> <br/>
								<span>KABUPATEN : </span><?php echo ucfirst(strtolower($item->nama_kabupaten)); ?> <br/>
								<span>ALAMAT : </span><?php echo $item->alamat; ?> <br/>
								<span>KONDISI : </span><?php echo $item->kondisi; ?> <br/>
							</p>
							
							<div class="page-header" id="page-header" style="margin-top:10px">
								<h1><small></small></h1>
							</div>
							
							<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
								<button type="submit" class="btn btn-primary btn-large">Hapus Listing</button>
								<?php echo anchor("#","Cancel",array("class"=>"btn btn-large")); ?>
							</div>
						</fieldset>
						<?php echo form_close(); ?>
						<?php endforeach; ?>
					</div>
					
				</div>
			
			</div>