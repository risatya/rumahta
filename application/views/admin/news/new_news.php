
				<div id="cpanel_wrapper">
				
					<fieldset>
					
						<legend>
							Buat Berita Baru
						</legend>
						
						<!--attach css file-->
						<link rel="stylesheet" href="<?php echo base_url();?>file/css/redactor_style.css" type="text/css" />
						
						<!--attach js file-->
						<script src="<?php echo base_url();?>file/js/redactor.min.js" type="text/javascript"></script>
						<script type="text/javascript"> 
						$(document).ready(
							function()
							{
								$('#redactor').redactor({
									buttons: ['formatting', '|', 'bold', 'italic', 'deleted', '|',
									'unorderedlist', 'orderedlist', 'table', 'link', '|',
									'fontcolor'],
									allowedTags: ["span", "div", "label", "a", "br", "p", "b", "i", "u", "blockquote", 
									"small", "hr", "dl", "dt", "dd", "sup", "sub", 
									"big", "pre", "code", "strong", "em", "table", "tr", "td", 
									"th", "tbody", "thead", "tfoot", "h1", "h2", "h3", "h4", "h5", "h6"]
								});
							}
						);
						</script>
						
						<?php echo form_open_multipart("news_manager/submit_news",array("class"=>"form-horizontal","name"=>"form")); ?>
						
							<div class="control-group">
								<label class="control-label">Judul : </label>
								<div class="controls docs-input-sizes">
								  <input class="span5" type="text" name="title" value="<?php echo set_value('title'); ?>" />*<i><?php echo form_error('title'); ?></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Isi Berita : </label>
								<div class="controls docs-input-sizes">
									<textarea id="redactor" name="isi" size="10" maxlength="50"><?php echo set_value('isi'); ?></textarea><i><?php echo form_error('isi'); ?></i>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Gambar Berita : </label>
								<div class="controls docs-input-sizes">
									<input type="file" name="news_photo" />
									*<p class="help-block">Upload gambar berita.</p>
								</div>
							</div>
							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Submit Berita</button>
								<button type="button" onclick="history.go(-1)" class="btn">Cancel</button>
							</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
					
				</div>
			
			</div>
			
		</div>