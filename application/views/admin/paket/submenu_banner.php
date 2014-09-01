
					<div id="cpanel_wrapper">
						
						<h3>Pengaturan Paket Listing</h3>
						
						<ul class="nav nav-tabs" style="float:left;width:100%;margin: 20px 0 0 0;">
						
							<?php echo $active == "daftar_paket" ? "<li class='active'>" : "<li>"; ?>
							<?php echo anchor("paket_banner_manager/index","Daftar Banner")."</li>";?>
							
							<?php echo $active == "konfirmasi" ? "<li class='active'>" : "<li>"; ?>
							<?php echo anchor("paket_banner_manager/konfirmasi","Konfirmasi Pembayaran Banner")."</li>";?>
							
							<?php echo $active == "paket_detail" ? "<li class='active'>" : "<li>"; ?>
							<?php echo anchor("paket_banner_manager/paket_detail","Pengaturan Detail Banner")."</li>";?>
							
						</ul>
						
						<!--<div class="navbar" style="float:left;width:100%;margin-top:20px;">
						  <div class="navbar-inner">
							<form class="navbar-form pull-left">
							  <input type="text" class="span3">
							  <button type="submit" class="btn">Cari Banner</button>
							</form>
						  </div>
						</div>-->
						
						<div style="width:100%;float:left;margin-top:20px">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						