					
					<div id="main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<?php foreach($news_detail as $item ):?>
						<fieldset>
							<legend><?php echo $item->title; ?></legend>
							
							posted on : <?php echo date('d-M-Y',strtotime($item->tanggal)); ?> 
							
							<div style="float:left;margin:-3px 0 10px 0;">
								<script type="text/javascript">var switchTo5x=true;</script>
								<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">stLight.options({publisher: "4d898c07-8504-480d-aa05-6a835c626475"}); </script>
								<span class='st_fbrec_hcount' displayText='Facebook Share'></span>
								<span class='st_twitter_hcount' displayText='Tweet'></span>
								<span class='st_plusone_hcount' displayText='Google +1'></span>
							</div>
							
							<br/><br/>
							
							<?php if($item->photo != null){ ?>
								<img src="<?php echo base_url(); ?>file/img/news/<?php echo $item->photo; ?>" align="left" style="margin:0 10px 10px 0;" />
							<?php } ?>
							
							<?php echo html_entity_decode($item->isi); ?>
							
						</fieldset>
						<?php endforeach; ?>
	