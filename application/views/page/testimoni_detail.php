					
					<div id="main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<?php foreach($testi_detail as $item ):?>
						<fieldset>
							<legend><?php echo "Testimoni ".$item->nama." (".$item->username.")"; ?></legend>
							
							submitted on : <?php echo date('d-M-Y',strtotime($item->tanggal)); ?> 
							
							<div style="float:left;margin:-3px 0 10px 0;">
								<script type="text/javascript">var switchTo5x=true;</script>
								<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">stLight.options({publisher: "4d898c07-8504-480d-aa05-6a835c626475"}); </script>
								<span class='st_fbrec_hcount' displayText='Facebook Share'></span>
								<span class='st_twitter_hcount' displayText='Tweet'></span>
								<span class='st_plusone_hcount' displayText='Google +1'></span>
							</div>
							
							<br/><br/>
							
							<img class="thumbnail" src="<?php echo base_url(); ?>file/img/pp/<?php echo ($item->user_photo != null ? $item->user_photo : "default_pp.jpg"); ?>" align="left" style="margin:0 10px 10px 0;" />
							
							<?php echo html_entity_decode($item->testimoni); ?>
							
						</fieldset>
						<?php endforeach; ?>
	