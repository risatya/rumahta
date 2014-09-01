				<div id="main_wrapper">
					<div id="main_title">
						<span>Lupa Password</span>
					</div>
					
					<p width="100%" style="float : left;"><small>Silakan masukkan username anda. lalu kami akan mengirimkan password anda yang baru ke email yang anda gunakan saat mendaftar.<small></p>
					<div id="main_line"></div>
					<div id="signup_form">
						<?php echo form_open_multipart("home/validate_forgot",array("class"=>"form-horizontal","name"=>"form")); ?>
							<fieldset>
							
							  <?php if($message!=null){ echo "<div class='alert alert-block'>".$message."</div>"; } ?>
							  <div class="control-group">
								<label class="control-label">Masukkan Username Anda:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="username" value="<?php echo set_value('username'); ?>" />*<i><?php echo form_error('username'); ?></i>
								</div>
							  </div>
							  
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Reset Password</button>
								<button class="btn">Cancel</button>
							  </div>
							  
							 
							</fieldset>
						<?php echo form_close(); ?>
					</div>