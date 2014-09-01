					
					<div id="main_wrapper">
						
						<?php 
						foreach($user as $item): 
							if($item->user_photo == null){
								$photo = "default_pp.jpg";
							}
							else{
								$photo = $item->user_photo;
							}
						?>
						<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $photo; ?>" align="left" class="img-polaroid" width="155px;" style="margin-right : 10px;">
						<fieldset>
							<legend><?php echo $item->nama." (".$item->register_as.")"; ?></legend>
							<blockquote>
								<?php	
								if($item->register_as != "individu"){
									$userlogo = ($item->company_photo == null ? "default_logo.jpg" : $item->company_photo);
								?>
									<img src="<?php echo base_url(); ?>file/img/company/<?php echo $userlogo; ?>" width="65px" class="img-polaroid" style="margin-right:10px;" align="right" />
								<?php } ?>
								<small><i class="icon-globe"></i>  <?php echo "Alamat : ".$item->alamat.", ".ucfirst(strtolower($item->kab)).", ".ucfirst(strtolower($item->provinsi))."."; ?></small>
								<small><i class="icon-envelope"></i> <?php echo $item->email; ?></small>
								<small>HP / Telp : <?php echo ($item->hp != null ? $item->hp : "").($item->hp != null && $item->telepon !=null ? " / " : "").($item->telepon != null ? $item->telepon : ""); ?></small>
								
								<?php if($item->register_as = "individu"){ ?>
									<p style="font-size : 13px;"><?php echo "Nama Perusahaan / Agen : ".($item->company_name != null ? $item->company_name : "-");?></p>					
									<?php $userlogo = ($item->company_photo == null ? "default_logo.jpg" : $item->company_photo); ?>
									<img src="<?php echo base_url(); ?>file/img/company/<?php echo $userlogo; ?>" align="right" width="60px" class="img-polaroid" style="position:absolute;margin:-60px 0 0 400px;" />
								<?php } ?>
							</blockquote>
						</fieldset>
						<?php endforeach; ?>
						
						<br/>
						
						<fieldset class="user_listing">
							<legend>Daftar Listing</legend>
							
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
									if($item->status_listing == 1){
								?>
										<div id="listing_premium_list2">
											<?php
												$str = "<span class='status'>".strtoupper($item->nama_kategori)."</span><span class='adv_name'>".(strlen($item->judul) > 50 ? substr($item->judul,0,47)."..." : $item->judul)."</span>";
												$str .= "<p class='adv_price'>".($item->harga != null ? "Rp. ".$item->harga : "Rp. -")."</p>";
											?>
											
											<?php echo anchor("page/listing_detail/".$item->id_listing_member,$str,array("id"=>"premium_title")); ?>
												
											<div id="premium_photo">
												<?php if($cover_listing[$counter] != null){ ?>
													<div class="photo_listing_wrapper">
														<?php if($item->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
														<?php echo anchor("page/listing_detail/".$item->id_listing_member,"<img src='".base_url()."file/img/premium/listing_pic/".$cover_listing[$counter]."' />")?>
													</div>
												<?php } else { ?>
													<div class="photo_listing_wrapper">
														<?php if($item->laku == 1){ ?><span class="photo_marker2"><i class="icon-tags icon-white"><?php echo ($item->status_kategori == 1 ? "TERJUAL" : "TERSEWA"); ?></i></span><?php } ?>
														<?php echo anchor("page/listing_detail/".$item->id_listing_member,"<img src='".base_url()."file/img/premium/listing_pic/default.jpg' />")?>
													</div>
												<?php } ?>
											</div>
											<div id="premium_detail">
												<b><?php echo ucfirst(strtolower($item->nama_kabupaten))." | ".date('d-F-Y',strtotime($item->submit_date)); ?></b><br/>
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
										<div id="premium_line2"></div>
								
								<?php
									}
									else{
										
										if($freecount == 0){
											?>
											<div id="listing_free_wrapper">
											<?php
										}
										?>
										<div id="listing_free_list">
											<div id="free_photo">
												<?php echo anchor("page/listing_detail/".$item->id_listing_member,"<img src='".base_url()."file/img/free/listing_pic/".$cover_listing[$counter]."' />"); ?>
											</div>
											<div id="free_detail">
												<?php echo anchor("page/listing_detail/".$item->id_listing_member,(strlen($item->judul) > 60 ? substr($item->judul,0,57)."..." : $item->judul),array("class"=>"free_title")); ?><br/>
												<?php echo ($item->status_kategori == 1 ? "Dijual" : "Disewakan") ?> - <?php echo $item->harga; ?> <br/>
												<?php echo (ucfirst(strtolower($item->nama_kabupaten)));?><br/>
												<?php echo (strlen($item->alamat) > 55 ? substr($item->alamat,0,52)."..." : $item->alamat); ?>
											</div>
										</div>
										<?php
										$freecount++;
										
									}
									$counter++;
								endforeach;
							}
							?>
							
						</fieldset>
						
						<div id="premium_title" style="margin: 20px 0 0 0px;"><p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p></div>