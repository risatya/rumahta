					<div id="cpanel_wrapper">
						
						<?php foreach($page_detail as $item):?>
						<fieldset>
						
							<legend style="float:left;width:670px;">
								<div style="float:left;margin-right:10px;"><?php echo $item->title; ?></div>
								
							</legend>
							
							<p style="align:justify;float:left">
								<?php echo html_entity_decode($item->content ); ?>
							</p>
							
							<div class="form-actions">
								<?php echo anchor("page_manager/edit/".$item->id_page,"Edit Halaman",array('class'=>'btn btn-primary')); ?>
								<?php echo anchor("page_manager/delete/".$item->id_page,"Hapus Halaman",array('class'=>'btn btn-primary')); ?>
								<?php echo anchor("#","Kembali",array('class'=>'btn btn-primary')); ?>
							</div>
							
						</fieldset>
						<?php endforeach; ?>
					</div>
					
				</div>
				
			</div>