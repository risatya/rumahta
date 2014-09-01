				<?php foreach($banner_detail as $item): ?>
					<fieldset>
					
						<legend>
							<?php echo "Detail Banner"; ?>
							<?php //echo anchor("paket_listing_manager/activate/".$item->id_konfirmasi_listing,"Aktifkan Paket",array("class"=>"label")); ?> <br/>
						</legend>
						
						<?php echo form_open("paket_banner_manager/set_banner/".$item->id_info_banner); ?>
						
						<div style="width:100%;float:left;line-height:30px;">
							
							<b>Status Banner : </b> Available <br/>
							<b>Posisi : </b> <?php echo $item->posisi; ?> <br/> <br/>
							<b>Ukuran Banner : </b> <br/>
							
							<?php
							
							// echo ($item->posisi == "atas" ? "<img src='".base_url()."file/img/banner/top_default.jpg'/>" : ($item->posisi == "samping" ? "<img src='".base_url()."file/img/banner/side_default.jpg'/>" : "<img src='".base_url()."file/img/banner/bottom_default.jpg'>"))
							
								switch($item->id_info_banner){
									case 1 :
										echo "<img src='".base_url()."file/img/banner/top_default.jpg'/>";
										break;
									case 2 :
										echo "<img src='".base_url()."file/img/banner/side_default1.jpg'/>";
										break;
									case 3 :
										echo "<img src='".base_url()."file/img/banner/side_default2.jpg'/>";
										break;
									case 4 :
										echo "<img src='".base_url()."file/img/banner/side_default3.jpg'/>";
										break;
									case 5 :
										echo "<img src='".base_url()."file/img/banner/side_default4.jpg'/>";
										break;
									case 6 :
										echo "<img src='".base_url()."file/img/banner/side_default5.jpg'/>";
										break;
									case 7 :
										echo "<img src='".base_url()."file/img/banner/bottom_default1.jpg'/>";
										break;
									case 8 :
										echo "<img src='".base_url()."file/img/banner/bottom_default2.jpg'/>";
										break;
								}
							
							?>
						
							<hr width="100%"/>
							
							<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
								<button type="submit" class="btn btn-primary btn-large">Pasang Banner</button>
								<button type="submit" class="btn btn-large">Kembali </button>
							</div>
							
						</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
				
				<?php endforeach; ?>
					
				</div>
			
			</div>