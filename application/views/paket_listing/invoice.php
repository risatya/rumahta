
					<div id="inside_main_wrapper">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
						<legend>Invoice Pembayaran Paket Listing</legend>
							<?php foreach($paket as $item): ?>
							<div class='alert alert-info'>
								<h3>Terima Kasih !</h3>
								Pemesanan paket listing anda dengan detail sbb : <br/>
								<i class="icon icon-tag"></i> Jenis Paket : <?php echo $item->nama_paket; ?><br/>
								<i class="icon icon-tasks"></i> Quota : <?php echo $item->maks_listing." Listing."; ?><br/>
								<i class="icon icon-time"></i> Durasi masing - masing listing: <?php echo $item->durasi_listing." Bulan."; ?><br/><br/>
								Akan kami aktifkan setelah anda melakukan pembayaran sebesar : <br/>
								<center><h3><?php echo "Rp. ".number_format($item->harga,0,",",".");?></h3></center>
								<!--Silakan lakukan pembayaran dan konfirmasi pembayaran sebelum tanggal : <br/>
								<center><h3><?php //echo date('d-M-Y',strtotime($exp_date)); ?></h3></center>-->
								
								<br/>
								Invoice juga kami kirimkan ke email anda! jika email belum terkirim harap cek terlebih dahulu folder SPAM anda. atau hubungi customer support kami <?php echo anchor("page/page_detail/3/kontak","Disini.",array("style"=>"color:#000"));?>
								<br/>
								
								Untuk prosedur / cara pembayaran selengkapnya dapat anda lihat di member area pada menu <b>Listing -> peraturan &amp; ketentuan</b>.<br/>
								Dan setelah pembayaran dilakukan silakan konfirmasikan pembayaran anda dengan mengisikan data transaksi pada <b>menu Listing -> Konfirmasi Pembayaran.</b> <br/><br/>
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