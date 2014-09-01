				<div id="admin_wrapper" class="well" >
					<div class="row">
						<div class="span4 well" style="margin:0 0 0 295px;;background:#fff;">
							<legend>LOGIN</legend>
							<?php if($message != null){ ?>
							<div class="alert alert-error">
								<a class="close" data-dismiss="alert" href="#">×</a><?php echo $message; ?>
							</div>
							<?php } ?>
							<hr/>
							<?php echo form_open("rumahtadotcom/validate_login"); ?>
								<input type="text" id="username" class="span4" name="username" placeholder="Username"><br/>
								<input type="password" id="password" class="span4" name="password" placeholder="Password"><br/>
								<label class="checkbox">
									<input type="checkbox" name="remember" value="1"> Remember Me
								</label>
								<button type="submit" name="submit" class="btn btn-info btn-block">Log in</button>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>