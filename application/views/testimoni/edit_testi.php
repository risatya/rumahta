
					<div id="inside_main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo "div id='redactor_content'".$message."</div>"; ?>
							</div>
						<?php } ?>
						
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
						
						<fieldset>
							<legend>Buat Testimoni</legend>
							<?php foreach($testi as $item): ?>
							<?php echo form_open("testimoni/do_edit/".$item->id_testimoni,array("class"=>"form-horizontal","name"=>"form")); ?>
								<textarea id="redactor" name="content" size="10" maxlength="50"><?php echo $item->testimoni ?></textarea>
								<p><small>Berikan testimoni anda tentang rumahta.com dan pengalaman anda dalam menggunakan fitur - fitur di rumahta.com. isi testimoni tidak boleh mengandung kata - kata kasar, provokasi, pornografi, dan tidak boleh mengandung SARA.</small></p>
								<button type="submit" class="btn btn-large btn-primary">Edit Testimoni</button>
							<?php echo form_close(); ?>
							<?php endforeach; ?>
						</fieldset>
					</div>
				