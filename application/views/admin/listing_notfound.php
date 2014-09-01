
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

							<fieldset>
								<legend>MAAF ! </legend>
								<div class='alert alert-important'>
									Listing tidak ditemukan.
								</div>
							</fieldset>
							
						</div>
						
					</div>
					
				</div>