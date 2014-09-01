
				<div id="cpanel_wrapper">
				
					<fieldset>
					
						<legend>
							Buat Berita Baru
						</legend>
						
						<?php if($message != null){ ?>
							<div class='alert alert-info' style="float:left;width:92%">
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						
						<?php echo form_open_multipart("page_manager/submit_page",array("class"=>"form-horizontal","name"=>"form")); ?>
						
							<div class="control-group">
								<label class="control-label">Judul Halaman: </label>
								<div class="controls docs-input-sizes">
								  <input class="span5" type="text" name="title" value="<?php echo set_value('title'); ?>" />*<i><?php echo form_error('title'); ?></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Nama Halaman : </label>
								<div class="controls docs-input-sizes">
								  <input class="span5" type="text" name="nama" value="<?php echo set_value('nama'); ?>" />*<i><?php echo form_error('nama'); ?></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Isi Content : </label>
								<div class="controls docs-input-sizes">
								</div>
							</div>
							
							<div style="width:690px">
								<script type="text/javascript" src="<?php echo base_url(); ?>asset/ckeditor/ckeditor.js"></script>
								<textarea class="ckeditor" name="isi" style="resize:vertical"><?php echo set_value('isi'); ?></textarea>
								<i><?php echo form_error('isi'); ?></i>
							</div>
							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Submit Halaman</button>
								<button type="button" onclick="history.go(-1)" class="btn">Cancel</button>
							</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
					
				</div>
			
			</div>
			
		</div>