
					<div id="cpanel_wrapper">
						
						<h3>Pengaturan Paket Listing</h3>
						
						<ul class="nav nav-tabs" style="float:left;width:100%;margin: 20px 0 0 0;">
						
							<?php echo $active == "daftar_paket" ? "<li class='active'>" : "<li>"; ?>
							<?php echo anchor("paket_listing_manager/all_paket","Daftar Paket")."</li>";?>
							
							<?php echo $active == "konfirmasi" ? "<li class='active'>" : "<li>"; ?>
							<?php echo anchor("paket_listing_manager/konfirmasi","Konfirmasi Pembayaran Paket")."</li>";?>
							
							<?php echo $active == "paket_detail" ? "<li class='active'>" : "<li>"; ?>
							<?php echo anchor("paket_listing_manager/paket_detail","Pengaturan Detail Paket")."</li>";?>
							
						</ul>
						
						<div class="navbar" style="float:left;width:100%;margin-top:20px;">
						  <div class="navbar-inner">
							<?php echo form_open('paket_listing_manager/search_paket',array('class' => 'navbar-form pull-left')); ?>
							  <input type="text" name="keyword" class="span3" placeholder="Masukan Username" />
							  <button type="submit" class="btn">Cari Paket Member</button>
							<?php echo form_close(); ?>
						  </div>
						</div>
						
						<div style="width:100%;float:left">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						