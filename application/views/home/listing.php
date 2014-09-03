			<?php if($premium > 0){?>	
				<div id="listing_premium_wrapper">
					<div id="listing_premium_title">
						<span>Listing Premium</span>
					</div>
					
					<?php 
					$x = 0;
					foreach($premium_listing as $item): 
					?>
					
					<div id="listing_premium_list">
						<?php
							$str = "<span class='status'>".strtoupper($item->nama_kategori)."</span><span class='adv_name'>".(strlen($item->judul) > 50 ? substr($item->judul,0,47)."..." : $item->judul)."</span>";
							$str .= "<p class='adv_price'>".date('d-M-Y',strtotime($item->submit_date))."</p>";
						?>
						
						<?php echo anchor("page/listing_detail/".$item->id_listing_member,$str,array("id"=>"premium_title")); ?>
							
						<div id="premium_photo">
							<?php if($cover_premium[$x] != null){ ?>
								<?php echo anchor("page/listing_detail/".$item->id_listing_member,"<img src='".base_url()."file/img/premium/listing_pic/".$cover_premium[$x]."' />")?>
							<?php } else { ?>
								<?php echo anchor("page/listing_detail/".$item->id_listing_member,"<img src='".base_url()."file/img/premium/listing_pic/default.jpg' />")?>
							<?php } ?>
						</div>
						<div id="premium_detail">
							<?php echo ucfirst(strtolower($item->nama_kabupaten)); ?> | <?php echo ($item->harga != null ? "Rp. ".$item->harga : "Rp. -"); ?><br/>
							<?php echo (strlen($item->alamat) > 70 ? substr($item->alamat,0,70)."..." : $item->alamat); ?> <br/>
							<?php echo (strlen($item->keterangan) > 70 ? substr($item->keterangan,0,70)."..." : $item->keterangan); ?> <br/>
							
							<p>
								<?php $z = 0; ?>
								<?php if($item->luas_bangunan != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_luas.png" title="Luas Bangunan"/> <?php echo $item->luas_bangunan; ?> M<sup>2</sup> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->luas_tanah != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_garden.png" title="Luas Tanah"/> <?php echo $item->luas_tanah; ?> M<sup>2</sup> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->jml_ktidur != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_bedroom.png" title="Kamar tidur"/> <?php echo $item->jml_ktidur; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->jml_kmandi != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_bathroom.png" title="Kamar mandi"/> <?php echo $item->jml_kmandi; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->garasi != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_garage.png" title="Garasi"/> <?php echo $item->garasi; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->jml_lantai != 0 && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_jumlahlantai.png" title="Jumlai lantai"/> <?php echo $item->jml_lantai; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->pembantu != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_pembantu.png" title="Kamar pembantu"/> <?php echo $item->pembantu; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->daya_listrik != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_listrik.png" title="Daya listrik"/> <?php echo $item->daya_listrik; ?>Watt &nbsp;&nbsp; <?php $z++; } ?>
								<?php if($item->sumber_air != null && $z <= 5){ ?><img src="<?php echo base_url(); ?>file/img/icon_water.png" title="Sumber air"/> <?php echo $item->sumber_air; ?> &nbsp;&nbsp; <?php $z++; } ?>
								<?php //echo anchor("page/listing_detail/".$item->id_listing_member,"Lihat Detail",array("class"=>"btn")); ?>
							</p>
						</div>
					</div>
					<div id="premium_line"></div>
					
					<?php 
					$x++;
					endforeach; 
					?>
					
				</div>
			<?php } ?>
			
				<div id="listing_free_wrapper">
					<?php 
					$z = 0;
					foreach($premium_listing as $item): 
					?>
					<div id="listing_free_list">
						<div id="free_photo">
							<?php echo anchor("page/listing_detail/".$item->id_listing_member,"<img src='".base_url()."file/img/free/listing_pic/".$cover_free[$z]."' />"); ?>
						</div>
						<div id="free_detail">
							<?php echo anchor("page/listing_detail/".$item->id_listing_member,(strlen($item->judul) > 60 ? substr($item->judul,0,57)."..." : $item->judul),array("class"=>"free_title")); ?><br/>
							<?php echo ($item->status_kategori == 1 ? "Dijual" : "Disewakan") ?> - <?php echo $item->harga; ?> <br/>
							<?php echo (ucfirst(strtolower($item->nama_kabupaten)));?><br/>
							<?php echo (strlen($item->alamat) > 55 ? substr($item->alamat,0,52)."..." : $item->alamat); ?>
						</div>
					</div>
					<?php 
					$z++;
					endforeach; 
					?>
					
					<?php if($premium > 6 || $free > 6){?>
						<?php $linkid = ($this->session->userdata('logged_in') == false ? "premium_title" : "premium_title2"); ?>
						<?php echo anchor("page/all","<p class='seemore'><img src='".base_url()."file/img/arrow_left.png'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LIHAT LEBIH BANYAK LISTING &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='".base_url()."file/img/arrow_right.png'/></p>",array("id"=>($this->session->userdata('logged_in') == false ? "premium_title" : "premium_title2"))); ?>
					<?php } ?>	
						
						