
					<div id="inside_main_wrapper">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<!--<fieldset>
						<legend>Informasi Listing Anda</legend>
						<div class="well" style="float:left;width:94%;padding-bottom:5px">
							<div style="width:63%;float:left;margin-bottom:10px;line-height:30px;">
								<?php// foreach($info_paket as $item): ?>
									<i class="icon icon-th-large"></i> Paket Listing : <span class="label label-success"><?php //echo $item->nama_paket; ?></span><br/>
									<i class="icon icon-tasks"></i> Quota untuk pasang Listing : <span class="label label-success"><?php //echo $item->quota; ?> Listing</span><br/>
									<i class="icon icon-tasks"></i> Durasi untuk tiap Listing : <span class="label label-success"><?php //echo $item->durasi_listing; ?> Bulan</span>
								<?php //endforeach; ?>
							</div>
							<div style="width:37%;float:left;">
								<div class="btn-group" style="float:right">
								  <?php //echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
								</div>
							</div>
						</div>
						</fieldset>-->
						
						<fieldset>
						<legend>Upgrade / Beli Paket Listing</legend>
						<?php foreach($paket_list as $item): ?>
						
							<?php if($item->status == 1){ ?>
						
							<div id="paket_list">
								<?php if($item->id_info_paket == 1){ ?>
									<img src="<?php echo base_url(); ?>file/img/icn_paket_bw.jpg" align="left" />
									<blockquote style="float:left;margin:8px 0 0 0;">
									  <p><b><?php echo $item->nama_paket." (Gratis)"; ?></b></p>
									  <small><i class="icon-tag"></i>  Quota : <b><?php echo $item->maks_listing." Listing."; ?></b></small>
									  <small><i class="icon-time"></i> Durasi setiap listing : <b><?php echo $item->durasi_listing." Bulan."; ?></b></small>
									</blockquote>
								<?php }else{ ?>
									<img src="<?php echo base_url(); ?>file/img/icn_paket.jpg" align="left" />
									<blockquote style="float:left;margin:8px 0 0 0;">
									  <p><b><?php echo $item->nama_paket; ?></b></p>
									  <small><i class="icon-tag"></i>  Quota : <b><?php echo $item->maks_listing." Listing."; ?></b></small>
									  <small><i class="icon-time"></i> Durasi setiap listing : <b><?php echo $item->durasi_listing." Bulan."; ?></b></small>
									</blockquote>
									<div id="harga_paket">
										<?php echo anchor("#konfirmasi".$item->id_info_paket,"Upgrade / Beli Paket",array("class"=>"btn btn-primary btn-large","data-toggle"=>"modal")); ?>
										<h4>
										<?php echo "Rp. ";
											$format_num = "";
											$length = strlen($item->harga); 
											for($x = 1; $x <= $length; $x++){
												$format_num = ($x % 3 == 0 ? ($x == $length ? substr($item->harga,($x*-1),1).$format_num : ".".substr($item->harga,($x*-1),1).$format_num) : substr($item->harga,($x*-1),1).$format_num);
											}
											echo $format_num;
											//echo number_format($item->harga,0,",",".");
										?>
										</h4>
									</div>
								<?php } ?>
							</div>
							<div class="page-header" id="page-header">
								<h1><small></small></h1>
							</div>
							
							<?php } ?>
							
						<?php endforeach; ?>
						</fieldset>
					
					</div>
					
					<script type="text/javascript">
						<?php foreach($konfirmasi as $item): ?>
							$('#konfirmasi<?php echo $item->info_paket; ?>').modal(options);
						<?php endforeach;?>
					</script>
					
					<?php foreach($paket_list as $item): ?>
					<div id="konfirmasi<?php echo $item->id_info_paket; ?>" class="modal hide fade">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Konfirmasi</h3>
						</div>
						<div class="modal-body">
							Anda Yakin ingin memesan paket ini ? <br/><br/>
						</div>
						<div class="modal-footer">
							<?php echo anchor("paket_listing/buy/".$item->id_info_paket,"Upgrade / Beli Paket",array("class"=>"btn btn-primary btn-large")); ?>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
					</div>
					<?php endforeach; ?>