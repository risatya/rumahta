
				<div id="cpanel_wrapper">
				
					<?php foreach($page_detail as $item):?>
					
					<fieldset>
					
						<legend>
							Edit Halaman
						</legend>
						
						<?php echo form_open_multipart("page_manager/do_edit/".$item->id_page,array("class"=>"form-horizontal","name"=>"form")); ?>
						
							<div class="control-group">
								<label class="control-label">Judul : </label>
								<div class="controls docs-input-sizes">
								  <input class="span5" type="text" name="title" value="<?php echo $item->title; ?>" />*<i><?php echo form_error('title'); ?></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Nama Halaman : </label>
								<div class="controls docs-input-sizes">
								  <input class="span5" type="text" name="nama" value="<?php echo $item->nama; ?>" />*<i><?php echo form_error('nama'); ?></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Isi Halaman : </label>
								<div class="controls docs-input-sizes">
								</div>
							</div>
							
							<div style="width:690px">
								<script type="text/javascript" src="<?php echo base_url(); ?>asset/ckeditor/ckeditor.js"></script>
								<textarea class="ckeditor" name="isi" style="resize:vertical"><?php echo html_entity_decode($item->content); ?></textarea>
								<i><?php echo form_error('isi'); ?></i>
							</div>
					
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Edit Halaman</button>
								<button type="button" onclick="history.go(-1)" class="btn">Cancel</button>
							</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
					<?php endforeach; ?>
					
				</div>
			
			</div>
			
		</div>