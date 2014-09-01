
					<div id="inside_main_wrapper">
						
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
						<legend>Slot Iklan banner yang tersedia : </legend>
						
						<!--banner atas -->
						<div class="page-header" id="page-header">
							<h1><small>Banner Atas</small></h1>
						</div>
						<div id="paket_list">
							<?php echo((1 - $topbanner) > 0 ? "<img src='".base_url()."file/img/icn_paket.jpg' align='left' />" : "<img src='".base_url()."file/img/icn_paket_bw.jpg' align='left' />"); ?>
							<blockquote style="float:left;margin:8px 0 0 0;">
							  <small> Posisi : <b>bagian atas halaman, di sebelah maskot website </b></small>
							  <small> Ukuran : <b>560 x 165 px</b></small>
							  <small> Slot tersedia : <b><?php echo(1-$topbanner)." Slot."; ?></b></small>
							</blockquote>
							<?php if((1-$topbanner) > 0){ ?>
								<div id="harga_paket">
									<?php echo anchor("member_banner/order_banner/1","Pesan Iklan Banner",array("class"=>"btn btn-primary btn-large")); ?>
								</div>
							<?php } ?>
						</div>
						
						<!--banner samping -->
						<div class="page-header" id="page-header">
							<h1><small>Banner Samping</small></h1>
						</div>
						<div id="paket_list">
							<?php echo((5 - $sidebanner) > 0 ? "<img src='".base_url()."file/img/icn_paket.jpg' align='left' />" : "<img src='".base_url()."file/img/icn_paket_bw.jpg' align='left' />"); ?>
							<blockquote style="float:left;margin:8px 0 0 0;">
							  <small> Posisi : <b>di bagian samping halaman, di bawah kalkulator KPR </b></small>
							  <small> Ukuran : <b>200 x 160 px</b></small>
							  <small> Slot tersedia : <b><?php echo(5-$sidebanner)." Slot."; ?></b></small>
							</blockquote>
							<?php if((5-$sidebanner) > 0){ ?>
								<div id="harga_paket">
									<?php echo anchor("member_banner/order_banner/2","Pesan Iklan Banner",array("class"=>"btn btn-primary btn-large")); ?>
								</div>
							<?php } ?>
						</div>
						
						<!--banner bawah -->
						<div class="page-header" id="page-header">
							<h1><small>Banner Bawah</small></h1>
						</div>
						<div id="paket_list">
							<?php echo((2 - $bottombanner) > 0 ? "<img src='".base_url()."file/img/icn_paket.jpg' align='left' />" : "<img src='".base_url()."file/img/icn_paket_bw.jpg' align='left' />"); ?>
							<blockquote style="float:left;margin:8px 0 0 0;">
							  <small> Posisi : <b>di bagian bawah halaman, di atas berita dan testimoni </b></small>
							  <small> Ukuran : <b>455 x 120 px</b></small>
							  <small> Slot tersedia : <b><?php echo(2-$bottombanner)." Slot."; ?></b></small>
							</blockquote>
							<?php if((2-$bottombanner) > 0){ ?>
								<div id="harga_paket">
									<?php echo anchor("member_banner/order_banner/3","Pesan Iklan Banner",array("class"=>"btn btn-primary btn-large")); ?>
								</div>
							<?php } ?>
						</div>
						
						<!--
						<img src="<?php// echo base_url(); ?>file/img/icn_paket_bw.jpg" align="left" />
						<blockquote style="float:left;margin:8px 0 0 0;">
						  <p><b><?php //echo $item->nama_paket." (Gratis)"; ?></b></p>
						  <small><i class="icon-tag"></i>  Quota : <b><?php //echo $item->maks_listing." Listing."; ?></b></small>
						  <small><i class="icon-time"></i> Durasi setiap listing : <b><?php// echo $item->durasi_listing." Bulan."; ?></b></small>
						</blockquote>
						
						<div class="page-header" id="page-header">
							<h1><small></small></h1>
						</div>
						-->
						</fieldset>
					
					</div>