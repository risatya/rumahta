				<div id="main_wrapper">
					<div id="main_title">
						<span>Login Member</span>
					</div>
					<div id="main_line"></div>
					<div id="inside_main_wrapper">
						<div class='alert alert-info'>
							<?php echo $message; ?>
						</div>
						<div id="login_wrapper">
						<?php echo form_open("home/validate_login",array("class"=>"form-horizontal")); ?>
							<fieldset>
								<br/><br/>
								  <div class="control-group">
									<label class="control-label">Username:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><i class="icon-user"></i></span><input class="span3" id="prependedInput" name="username" size="3" type="text" />
									  </div>
									</div>
								  </div>
								   <div class="control-group">
									<label class="control-label">Password:</label>
									<div class="controls">
									  <div class="input-prepend">
										<span class="add-on"><i class="icon-lock"></i></span><input class="span3" id="prependedInput" name="password" size="3" type="password" />
									  </div>
									</div>
								  </div>
								   <div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-primary">Login</button>
										<button class="btn">Cancel</button>
									</div>
								  </div>
							</fieldset>
							<br/><hr/>
						</div>
					</div>