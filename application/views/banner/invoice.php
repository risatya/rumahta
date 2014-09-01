
					<div id="inside_main_wrapper">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
						<legend>Invoice Pembayaran Pemesanan banner</legend>
							<?php foreach($banner_dummy as $item): ?>
							<div class='alert alert-info'>
								<h3>Terima Kasih !</h3>
								Pemesanan banner anda dengan detail sbb : <br/>
								<?php $a = $item->id_info_banner; ?>
								<i class="icon icon-tag"></i> Jenis Banner : <?php echo ($a == 1 ? "banner atas" : (($a == 7 || $a == 8) ? "banner bawah ".($a-6) : "banner kanan ".($a-1))); ?><br/>
								<i class="icon icon-time"></i> Durasi: <?php echo $item->durasi." Bulan."; ?><br/><br/>
								Akan kami aktifkan setelah anda melakukan pembayaran sebesar : <br/>
								<center><h3><?php echo "Rp. ".number_format($item->harga,0,",",".");?></h3></center>
								Silakan lakukan pembayaran dan konfirmasi pembayaran sebelum tanggal : <br/>
								<center><h3><?php echo date('d-M-Y',strtotime($item->tolerance_date)); ?></h3></center>
								Untuk prosedur / cara pembayaran selengkapnya dapat anda lihat di member area pada menu <b>Banner -> peraturan &amp; ketentuan</b>.<br/>
								Dan setelah pembayaran dilakukan silakan konfirmasikan pembayaran anda dengan mengisikan data transaksi pada <b>menu Banner -> Konfirmasi Pembayaran.</b> <br/><br/>
								<br/><br/>
							</div>
							<?php endforeach;?>
						</fieldset>
						
						<!--<fieldset>
						<legend>Informasi Listing Anda</legend>
						<div class="well" style="float:left;width:94%;padding-bottom:5px">
							<div style="width:63%;float:left;margin-bottom:10px;line-height:30px;">
								<?php //foreach($info_paket as $item): ?>
									<i class="icon icon-th-large"></i> Paket Listing : <span class="label label-success"><?php //echo $item->nama_paket; ?></span><br/>
									<i class="icon icon-tasks"></i> Quota untuk pasang Listing : <span class="label label-success"><?php// echo $item->quota; ?> Listing</span><br/>
									<i class="icon icon-tasks"></i> Durasi untuk tiap Listing : <span class="label label-success"><?php// echo $item->durasi_listing; ?> Bulan</span>
								<?php //endforeach; ?>
							</div>
							<div style="width:37%;float:left;">
								<div class="btn-group" style="float:right">
								  <?php //echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
								</div>
							</div>
						</div>
						</fieldset>-->
					
					</div>