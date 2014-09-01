					
					<div id="main_wrapper">
						
						<?php foreach($page_content as $item ):?>
						<fieldset>
							<legend><?php echo $item->title; ?></legend>
							
							<div style="float:left;margin:-3px 0 10px 0;">
								<script type="text/javascript">var switchTo5x=true;</script>
								<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">stLight.options({publisher: "4d898c07-8504-480d-aa05-6a835c626475"}); </script>
								<span class='st_fbrec_hcount' displayText='Facebook Share'></span>
								<span class='st_twitter_hcount' displayText='Tweet'></span>
								<span class='st_plusone_hcount' displayText='Google +1'></span>
							</div>
							
							<br/><br/>
							
							<?php echo html_entity_decode($item->content); ?>
							
						</fieldset>
						<?php endforeach; ?>
	