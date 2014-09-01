					<div id="cpanel_wrapper">
						
						<?php foreach($news_detail as $item):?>
						<fieldset>
						
							<legend style="float:left;width:670px;">
								<div style="float:left;margin-right:10px;"><?php echo $item->title; ?></div>
								
							</legend>
							
							<p style="align:justify">
								<?php if($item->photo != null){ ?>
									<img src="<?php echo base_url(); ?>file/img/news/<?php echo $item->photo ?>" align="left" style="margin:0 20px 10px 0;" />
								<?php } ?>
								<?php echo str_replace(array("<p>","</p>"),"",html_entity_decode($item->isi )); ?>
							</p>
							
							<div class="form-actions">
								<?php echo anchor("news_manager/edit/".$item->id_artikel,"Edit Berita",array('class'=>'btn btn-primary')); ?>
								<?php echo anchor("news_manager/delete/".$item->id_artikel,"Hapus Berita",array('class'=>'btn btn-primary')); ?>
								<?php echo anchor("#","Kembali",array('class'=>'btn btn-primary')); ?>
							</div>
							
						</fieldset>
						<?php endforeach; ?>
					</div>
					
				</div>
				
			</div>