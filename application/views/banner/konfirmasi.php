
					<div id="inside_main_wrapper">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
						<legend>Konfirmasi Pembayaran</legend>
							
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="2%">No</th>
										<th width="20%">Jenis Banner</th>
										<th width="13%">Harga</th>
										<th width="10%">Durasi</th>
										<th width="15%">Tanggal pemesanan</th>
										<th width="15%">Batas Pembayaran</th>
										<!--<th width="7%">Status</th>-->
										<th width="23%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1; 
									foreach($konfirmasi as $item): ?>
									<tr>
										<?php $a = $item->id_info_banner; ?>
										<td><?php echo $no; ?></td>
										<td><?php echo ($a == 1 ? "banner atas" : (($a == 7 || $a == 8) ? "banner bawah ".($a-6) : "banner kanan ".($a-1))); ?></td>
										<td><?php echo number_format($item->harga,0,",","."); ?></td>
										<td><?php echo $item->durasi." Bulan"; ?></td>
										<td><?php echo date('d-M-Y',strtotime($item->submit_date)); ?></td>
										<td><?php echo date('d-M-Y',strtotime($item->tolerance_date)); ?></td>
										<!--<td>
											<?php
											// $now = strtotime(date('Y-m-d'));
											// $exp = strtotime($item->tolerance_date);
											// if($now <= $exp){
												// echo "<span class='label label-success' style='float:left;margin-top:5px'>Aktif</span>";
											// }
											// else{
												// echo "<span class='label label-important' style='float:left;margin-top:5px'>Expired</span>";
											// }
											?>
										</td>-->
										<td>
											<?php echo anchor("#konfirmasi".$item->id_banner_dummy,"<i class='icon icon-share-alt'></i> Konfirmasi",array("class"=>"btn btn-small","data-toggle"=>"modal","title"=>"Konfirmasi Pembayaran")); ?>
											<?php echo anchor("#konfirmasi_batal".$item->id_banner_dummy,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","data-toggle"=>"modal","style"=>"width:10px;","title"=>"Batalkan pemesanan")); ?>
										</td>
									</tr>
									<?php $no++; ?>
									<?php endforeach;?>
								</tbody>
							</table>
							
							<?php if($no <= 1){ ?>
								<div class="alert alert-info">
									Tidak ada banner yang sedang dipesan. Silakan pesan paket listing yang anda inginkan terlebih dahulu.
									<?php echo anchor("member_banner/index","Pesan iklan banner disini",array("class"=>"btn")) ?>
								</div>
							<?php } ?>
					
						</fieldset>
						
						<!--<fieldset>
						<legend>Informasi Paket Listing Anda</legend>
						<div class="well" style="float:left;width:94%;padding-bottom:5px">
							<div style="width:63%;float:left;margin-bottom:10px;line-height:30px;">
								<?php //foreach($info_paket as $item): ?>
									<i class="icon icon-th-large"></i> Paket Listing : <span class="label label-success"><?php //echo $item->nama_paket; ?></span><br/>
									<i class="icon icon-tasks"></i> Quota untuk pasang Listing : <span class="label label-success"><?php //echo $item->quota; ?> Listing</span><br/>
									<i class="icon icon-tasks"></i> Durasi untuk tiap Listing : <span class="label label-success"><?php //echo $item->durasi_listing; ?> Bulan</span>
								<?php //endforeach; ?>
							</div>
							<div style="width:37%;float:left;">
								<div class="btn-group" style="float:right">
								  <?php// echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
								</div>
							</div>
						</div>
						</fieldset>
						-->
					
					</div>
					
					<script type="text/javascript">
						<?php foreach($konfirmasi as $item): ?>
							$('#konfirmasi<?php echo $item->id_banner_dummy; ?>').modal(options);
							$('#konfirmasi_batal<?php echo $item->id_banner_dummy; ?>').modal(options);
						<?php endforeach;?>
					</script>
					
					<!--attach file css-->
					<link rel="stylesheet" href="<?php echo base_url();?>file/css/jquery-ui-1.8.23.custom.css" type="text/css" />
					
					<!--attach file js-->
					<script src="<?php echo base_url();?>file/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
					<script type="text/javascript">
						$(document).ready(function () {
							$('#datepicker').datepicker({
								inline: true,
								dateFormat : 'yy-mm-dd'
							});
						});
					</script>
					
					<?php foreach($konfirmasi as $item): ?>
					<div id="konfirmasi<?php echo $item->id_banner_dummy; ?>" class="modal hide fade">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h4>Konfirmasi Pembayaran Pemesanan <?php echo ($a == 1 ? "banner atas" : (($a == 7 || $a == 8) ? "banner bawah ".($a-6) : "banner kanan ".($a-1))); ?></h4>
						</div>
						
						<script type="text/javascript">
						$(document).ready(function(){
							
							$("#sistem").change(function(){
								var sist = this.value;
								if(sist == 1){
									$("#bankasal,#norek,#atasnama,#banktujuan").show();
								}
								else{
									$("#bankasal,#norek,#atasnama,#banktujuan").hide();
								}
							});
							
						});
						</script>
						
						<div class="modal-body">
							<?php echo form_open("member_banner/do_confirm/".$item->id_banner_dummy."/".$item->id_harga,array("class"=>"form-horizontal","name"=>"form")); ?>
								Isikan form dengan lengkap dan benar. data tidak dapat diganti setelah anda melakukan konfirmasi.<br/>
								Field dengan tanda * (bintang) harus diisi.<br/><br/>
								<div class="control-group">
								<label class="control-label">Tanggal pembayaran: </label>
								<div class="controls docs-input-sizes">
									<p><input type="text" id="datepicker" name="tanggal"  />*</p>
								</div>
								</div>
								
								<div class="control-group">
								<label class="control-label">Sistem Pembayaran : </label>
								<div class="controls docs-input-sizes">
									<select name="sistem" id="sistem" size="1">
										<option value="1">Transfer</option>
										<option value="2">Tunai</option>
									</select>*
								</div>
								</div>
								
								<div class="control-group">
								<label class="control-label">Besar pembayaran: </label>
								<div class="controls docs-input-sizes">
									<div class="input-prepend">
										<span class="add-on">Rp. </span><input class="span2" id="prependedInput" name="besar_byr" size="3" type="text" />*
									 </div>
								</div>
								</div>
								
								<div class="control-group" id="bankasal">
								<label class="control-label">Bayar dari bank : </label>
								<div class="controls docs-input-sizes">
									<input class="span2" type="text" name="bank_asal"/>*
								</div>
								</div>
								
								<div class="control-group" id="norek">
								<label class="control-label">Nomor rekening : </label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="no_rek"/>*
								</div>
								</div>
								
								<div class="control-group" id="atasnama">
								<label class="control-label">Atas nama : </label>
								<div class="controls docs-input-sizes">
									<input class="span3" type="text" name="atas_nama"/>*
								</div>
								</div>
								
								<div class="control-group" id="banktujuan">
								<label class="control-label">Bank tujuan transfer : </label>
								<div class="controls docs-input-sizes">
									<select name="bank_tujuan" size="1">
										<option value="bca">BCA</option>
										<option value="mandiri">Mandiri</option>
										<option value="bni">BNI</option>
									</select>*
								</div>
								</div>
								
								<div class="control-group">
								<label class="control-label">Pesan : </label>
								<div class="controls docs-input-sizes">
									<textarea rows="3" class="field span3" name="pesan" style="resize:none;"></textarea>
								</div>
								</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-large">Konfirmasi Pembayaran</button>
							<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
					</div>
					
					<div id="konfirmasi_batal<?php echo $item->id_banner_dummy; ?>" class="modal hide fade">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Konfirmasi</h3>
						</div>
						<div class="modal-body">
							Anda Yakin ingin membatalkan pemesanan banner ini ? <br/><br/>
						</div>
						<div class="modal-footer">
							<?php echo anchor("member_banner/cancel/".$item->id_banner_dummy,"Batalkan Pemesanan",array("class"=>"btn btn-primary btn-large")); ?>
							<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
					</div>
					<?php endforeach; ?>