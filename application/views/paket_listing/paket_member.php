
					<div id="inside_main_wrapper">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
						<legend>Pilih Paket yang akan dipakai untuk Pasang Listing / Iklan :</legend>
						<?php $z = 0; ?>
						<?php foreach($paket_list as $item): ?>
						
							<?php if($item->status == 1 || ($item->status == 0 && $member_paket[$z]['id_paket'] != null)){ ?>
							
							<div id="paket_list">
									<img src="<?php echo base_url(); ?>file/img/<?php echo ( $member_paket[$z]['id_paket'] == null || $member_paket[$z]['quota'] < 1 ? "icn_paket_bw.jpg" : "icn_paket.jpg"); ?>" align="left" />
									<blockquote style="float:left;margin:8px 0 0 0;">
										<p><?php echo ( $member_paket[$z]['id_paket'] == null || $member_paket[$z]['quota'] < 1 ? "<b><font color='#999999'>".$item->nama_paket." (Tidak Aktif)</font></b>" : "<b>".$item->nama_paket."</b>") ?></p>
										<small><i class="icon-tag"></i> <?php echo($member_paket[$z]['id_paket'] == null ? "Quota : ".$member_paket[$z]['quota_paket'] : ($member_paket[$z]['quota'] < 1 ? "Quota : Habis" : "<b>Quota : ".$member_paket[$z]['quota']." Listing.</b>")); ?></small>
										<small><i class="icon-time"></i> <?php echo($member_paket[$z]['id_paket'] == null || $member_paket[$z]['quota'] < 1 ? "Durasi setiap listing : ".$member_paket[$z]['durasi']." Bulan." : "<b>Durasi setiap listing : ".$member_paket[$z]['durasi']." Bulan.</b>")?>
									</blockquote>
									<div id="harga_paket">
										<?php
											if($item->id_info_paket != 1){
												if($member_paket[$z]['id_paket'] == null || $member_paket[$z]['quota'] <= 0){
													echo anchor("#konfirmasi".$item->id_info_paket,"Upgrade / Beli Paket",array("class"=>"btn btn-large","data-toggle"=>"modal"));											
												}
												else{
													echo anchor("member_listing/add_listing/".$member_paket[$z]['id_paket'],"Pasang Listing / Iklan",array("class"=>"btn btn-primary btn-large"));
												}
											}
											else{
												if($member_paket[$z]['quota'] > 0){
													echo anchor("member_listing/add_listing/".$member_paket[$z]['id_paket'],"Pasang Listing / Iklan",array("class"=>"btn btn-primary btn-large"));
												}
											}
										?>
										<h4>
										<?php 
											// $format_num = "";
											// $length = strlen($item->harga); 
											// for($x = 1; $x <= $length; $x++){
												// $format_num = ($x % 3 == 0 ? ($x == $length ? substr($item->harga,($x*-1),1).$format_num : ".".substr($item->harga,($x*-1),1).$format_num) : substr($item->harga,($x*-1),1).$format_num);
											// }
											// echo $format_num;
											echo($member_paket[$z]['id_paket'] == null ? "<font color='#999999'>Rp. ".number_format($item->harga,0,",",".")."</font>" : ""/*"Rp. ".number_format($item->harga,0,",",".")*/);
										?>
										</h4>
									</div>
							</div>
							<div class="page-header" id="page-header">
								<h1><small></small></h1>
							</div>
							<?php $z++; ?>
							
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