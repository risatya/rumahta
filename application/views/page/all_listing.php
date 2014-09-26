<div id="listing_premium_wrapper">
					<div id="listing_premium_title">
						<span>Listing Premium</span>
					</div>
<?php 
error_reporting(0);
foreach($premium_listing as $premiumitem): 

?>
<div id="listing_premium_list">
						<?php
							$str = "<span class='status'>".strtoupper($premiumitem->nama_kategori)."</span><span class='adv_name'>".(strlen($premiumitem->judul) > 50 ? substr($premiumitem->judul,0,47)."..." : $premiumitem->judul)."</span>";
							$str .= "<p class='adv_price'>".($premiumitem->harga != null ? "Rp. ".$premiumitem->harga : "Rp. -")."</p>";
						?>
						
						<?php echo anchor("page/listing_detail/".$premiumitem->id_listing_member."/".url_title($premiumitem->nama_kategori."-".$premiumitem->judul),$str,array("id"=>"premium_title")); ?><h2>
							
						<div id="premium_photo">
							<?php if($cover_listing[$counter] != null){ ?>
								<div class="photo_listing_wrapper">
									<?php if($premiumitem->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($premiumitem->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
									<?php echo anchor("page/listing_detail/".$premiumitem->id_listing_member."/".url_title($premiumitem->nama_kategori."-".$premiumitem->judul),"<img src='".base_url()."file/img/premium/listing_pic/".$cover_listing[$counter]."' />")?>
								</div>
							<?php } else { ?>
								<div class="photo_listing_wrapper">
									<?php if($premiumitem->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($premiumitem->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
									<?php echo anchor("page/listing_detail/".$premiumitem->id_listing_member."/".url_title($premiumitem->nama_kategori."-".$premiumitem->judul),"<img src='".base_url()."file/img/premium/listing_pic/default.jpg' />")?>
								</div>
							<?php } ?>
						</div>
						<div id="premium_detail">
							<b><?php echo ucfirst(strtolower($premiumitem->nama_kabupaten))." | ".date('d-F-Y',strtotime($premiumitem->submit_date)); ?></b><br/>
							<?php echo (strlen($premiumitem->alamat) > 60 ? substr($premiumitem->alamat,0,60)."..." : $premiumitem->alamat); ?> <br/>
							<?php echo (strlen($premiumitem->keterangan) > 60 ? substr($premiumitem->keterangan,0,60)."..." : $premiumitem->keterangan); ?> <br/>
							
							<p>
								<?php $z = 0; ?>
								<?php if($premiumitem->luas_bangunan > 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_luas.png" title="Luas Bangunan"/> <?php echo $premiumitem->luas_bangunan; ?> M<sup>2</sup> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->luas_tanah > 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_garden.png" title="Luas Tanah"/> <?php echo $premiumitem->luas_tanah; ?> M<sup>2</sup> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->jml_ktidur != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_bedroom.png" title="Kamar tidur"/> <?php echo $premiumitem->jml_ktidur; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->jml_kmandi != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_bathroom.png" title="Kamar mandi"/> <?php echo $premiumitem->jml_kmandi; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->garasi != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_garage.png" title="Garasi"/> <?php echo $premiumitem->garasi; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->jml_lantai != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png" title="Jumlah lantai"/> <?php echo $premiumitem->jml_lantai; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->pembantu != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_pembantu.png" title="Kamar pembantu"/> <?php echo $premiumitem->pembantu; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->daya_listrik != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_listrik.png" title="Daya listrik"/> <?php echo $premiumitem->daya_listrik; ?>Watt &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->sumber_air != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_water.png" title="Sumber air"/> <?php echo $premiumitem->sumber_air; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($premiumitem->mata_angin != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_compas.png" title="Sumber air"/> <?php echo $premiumitem->mata_angin; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php $z = 0; ?>
							</p>
						</div>
					</div>
					<div id="premium_line"></div>
					<?php endforeach ?>

				</div>
				<div id="listing_premium_wrapper">
<?php
	foreach($list_listing as $item){
?>
						<div id="listing_premium_list">
						<?php
							$str = "<span class='status'>".strtoupper($item->nama_kategori)."</span><span class='adv_name'>".(strlen($item->judul) > 50 ? substr($item->judul,0,47)."..." : $item->judul)."</span>";
							$str .= "<p class='adv_price'>".($item->harga != null ? "Rp. ".$item->harga : "Rp. -")."</p>";
						?>
						
						<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),$str,array("id"=>"premium_title")); ?>
							
						<div id="premium_photo">
							<?php if($cover_listing[$counter] != null){ ?>
								<div class="photo_listing_wrapper">
									<?php if($item->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
									<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),"<img src='".base_url()."file/img/free/listing_pic/".$cover_listing[$counter]."' />")?>
								</div>
							<?php } else { ?>
								<div class="photo_listing_wrapper">
									<?php if($item->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
									<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),"<img src='".base_url()."file/img/premium/listing_pic/default.jpg' />")?>
								</div>
							<?php } ?>
						</div>
						<div id="premium_detail">
							<b><?php echo ucfirst(strtolower($item->nama_kabupaten))." | ".date('d-F-Y',strtotime($item->submit_date)); ?></b><br/>
							<?php echo (strlen($item->alamat) > 60 ? substr($item->alamat,0,60)."..." : $item->alamat); ?> <br/>
							<?php echo (strlen($item->keterangan) > 60 ? substr($item->keterangan,0,60)."..." : $item->keterangan); ?> <br/>
							
							<p>
								<?php $z = 0; ?>
								<?php if($item->luas_bangunan > 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_luas.png" title="Luas Bangunan"/> <?php echo $item->luas_bangunan; ?> M<sup>2</sup> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->luas_tanah > 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_garden.png" title="Luas Tanah"/> <?php echo $item->luas_tanah; ?> M<sup>2</sup> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->jml_ktidur != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_bedroom.png" title="Kamar tidur"/> <?php echo $item->jml_ktidur; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->jml_kmandi != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_bathroom.png" title="Kamar mandi"/> <?php echo $item->jml_kmandi; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->garasi != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_garage.png" title="Garasi"/> <?php echo $item->garasi; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->jml_lantai != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png" title="Jumlah lantai"/> <?php echo $item->jml_lantai; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->pembantu != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_pembantu.png" title="Kamar pembantu"/> <?php echo $item->pembantu; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->daya_listrik != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_listrik.png" title="Daya listrik"/> <?php echo $item->daya_listrik; ?>Watt &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->sumber_air != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_water.png" title="Sumber air"/> <?php echo $item->sumber_air; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->mata_angin != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_compas.png" title="Sumber air"/> <?php echo $item->mata_angin; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php $z = 0; ?>
							</p>
						</div>
					</div>
					<div id="premium_line"></div>
					<?php 


}


					?>

					<div id="premium_title" style="margin: 10px 0 0 0px;"><p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p></div>