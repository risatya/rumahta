
					<div id="cpanel_wrapper">
						
						<h3>Pengaturan Iklan Listing</h3>
						
						<div class="navbar" style="float:left;width:100%;margin-top:20px;">
						  <div class="navbar-inner">
							<?php echo form_open('listing_manager/search_listing',array('class' => 'navbar-form pull-left')); ?>
							  <input type="text" name="keyword" class="span3" placeholder="Masukan Judul Listing">
							  <button type="submit" class="btn">Cari Listing</button>
							<?php echo form_close(); ?>
						  </div>
						</div>
						
						<div style="width:100%;float:left">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						