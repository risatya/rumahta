					
					<div id="main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<?php foreach($all_testi as $item ):?>
						<fieldset style="margin-bottom:10px">
							<legend><span class="judul_berita"><?php echo $item->nama." (".$item->username.")"; ?></span></legend>
							
							<img class="thumbnail" src="<?php echo base_url(); ?>file/img/pp/<?php echo ($item->user_photo != null ? $item->user_photo : "default_pp.jpg"); ?>" align="left" style="margin:0 10px 10px 0;" width="115px" />
							
							<b>posted on : <?php echo date('d-M-Y',strtotime($item->tanggal)); ?> </b> <br/>
							
							<?php echo substr(str_replace(array("<p>","</p>","<br>","<br/>","<div>","</div>"),"",html_entity_decode($item->testimoni)),0,220); ?>
							
							<br/>
							
							<?php echo anchor("page/testimoni_detail/".$item->id_testimoni,"Baca Selengkapnya",array("class" => "btn btn-success","style" => "margin:10px 0 0 0")); ?>
							
						</fieldset>
						<?php endforeach; ?>
						
						<div id="premium_title" style="margin: 0 0 0 0px;"><p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p></div>
	