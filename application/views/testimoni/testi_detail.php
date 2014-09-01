
					<div id="inside_main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
							<legend>
							Detail Testimoni
							<?php echo anchor("testimoni/edit/".$testi['id_testimoni'],"Edit Testimoni",array("style"=>"float:right;margin-top:10px;")); ?>
							</legend>
							<?php echo $testi['testimoni']; ?>
						</fieldset>
					</div>
				