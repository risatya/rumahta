<?php
	$itung = 0;
	foreach($list_listing as $item){
		$itung++;
	}

	if($itung > 0){
		$counter = 0;
		$freecount = 0;
		//print_r($list_listing);
		foreach($list_listing as $item):
			if($counter == 0){
				if($item->status_listing == 1){
				?>
					<div id="listing_premium_wrapper">
					<div id="listing_premium_title">
						<span>Listing Premium</span>
					</div>
					<div id="listing_premium_list">
						<?php
							$str = "<span class='status'>".strtoupper($item->nama_kategori)."</span><span class='adv_name'>".(strlen($item->judul) > 50 ? substr($item->judul,0,47)."..." : $item->judul)."</span>";
							$str .= "<p class='adv_price'>".($item->harga != null ? "Rp. ".$item->harga : "Rp. -")."</p>";
						?>
						
						<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),$str,array("id"=>"premium_title")); ?><h2>
							
						<div id="premium_photo">
							<?php if($cover_listing[$counter] != null){ ?>
								<div class="photo_listing_wrapper">
									<?php if($item->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
									<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),"<img src='".base_url()."file/img/premium/listing_pic/".$cover_listing[$counter]."' />")?>
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
				else{
					?>
					<div id="listing_premium_wrapper">
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
									<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),"<img src='".base_url()."file/img/free/listing_pic/default.jpg' />")?>
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
					$freecount++;
				}
			}
			else{
				if($item->status_listing == 1){
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
									<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),"<img src='".base_url()."file/img/premium/listing_pic/".$cover_listing[$counter]."' />")?>
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
							<?php echo (strlen($item->keterangan) > 65 ? substr($item->keterangan,0,65)."..." : $item->keterangan); ?> <br/>
							
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
								<?php //echo anchor("page/listing_detail/".$item->id_listing_member,"Lihat Detail",array("class"=>"btn")); ?>
							</p>
						</div>
					</div>
					<div id="premium_line"></div>
				<?php
				}
				else{
					if($freecount == 0){
						?>
						</div>
						<div id="listing_premium_wrapper">
						
						<?php
					}
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
									<?php echo anchor("page/listing_detail/".$item->id_listing_member."/".url_title($item->nama_kategori."-".$item->judul),"<img src='".base_url()."file/img/free/listing_pic/default.jpg' />")?>
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
								<?php
								if($item->daya_listrik != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_listrik.png" title="Daya listrik"/> <?php echo $item->daya_listrik; ?>Watt &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->sumber_air != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_water.png" title="Sumber air"/> <?php echo $item->sumber_air; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->mata_angin != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_compas.png" title="Sumber air"/> <?php echo $item->mata_angin; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php $z = 0; ?>
							</p>
						</div>
					</div>
					<?php
					$freecount++;
				}
			}
			$counter++;
		endforeach;
		?>
		<div id="premium_title" style="margin: 10px 0 0 0px;"><p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p></div>
	<?php
	}
	else{
		echo "<div id='main_wrapper'>";
	}
	?>