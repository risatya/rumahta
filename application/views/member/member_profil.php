					
					<div id="inside_main_wrapper">
						
						<!--<div class="well" style="padding-bottom:35px">
							<div style="width:47%;float:left;margin-bottom:10px;">
								<?php //foreach($info_paket as $item): ?>
									<i class="icon icon-th-large"></i> Paket Listing : <span class="label label-success"><?php //echo $item->nama_paket; ?></span><br/>
									<i class="icon icon-tasks"></i> Quota untuk pasang Listing : <span class="label label-success"><?php //echo $item->quota; ?> Listing</span>
								<?php //endforeach; ?>
							</div>
							<div style="width:53%;float:right;">
								<div class="btn-group">
								  <?php //echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
								  <?php //echo anchor("#","<i class='icon icon-arrow-up'></i> Upgrade Paket Listing",array("class"=>"btn")); ?>
								</div>
							</div>
						</div>-->
					<!--	<div style="width : 100%;height : 50px;">
							<div class="btn-group" style="float:right;">
							  <?php //echo anchor("member_listing/add_listing","<i class='icon icon-tag'></i> Pasang Listing",array("class"=>"btn")); ?>
							  <?php //echo anchor("#","<i class='icon icon-arrow-up'></i> Upgrade Paket Listing",array("class"=>"btn")); ?>
							</div>
						</div>-->
						
						<?php 
						foreach($member_profile as $item): 
							if($item->user_photo == null){
								$photo = "default_pp.jpg";
							}
							else{
								$photo = $item->user_photo;
							}
						?>
						<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $photo; ?>" align="left" class="img-polaroid" style="margin-right : 10px;">
						<fieldset>
							<legend><?php echo $item->nama; ?></legend>
							<blockquote>
							  <p><?php echo $item->alamat.", ".ucfirst(strtolower($item->kab)).", ".ucfirst(strtolower($item->provinsi))."."; ?></p>
							  <small><i class="icon-user"></i>  <?php echo "mendaftar sebagai : ".$item->register_as; ?></small>
							  <small><i class="icon-envelope"></i>  <?php echo $item->email; ?></small>
							</blockquote>
							<?php echo anchor("member/edit_profile","Edit Profile",array("class"=>"btn btn-small","style"=>"margin-top : -20px;")) ?>
						</fieldset>
						<hr/>
						<?php endforeach; ?>
						
						<fieldset>
							<legend>Statistik Pengunjung <?php echo anchor("statistik/index","Lihat Statistik Selengkapnya",array("class"=>"label")); ?></legend>
							<link href="<?php echo base_url(); ?>file/css/flotstyle.css" rel="stylesheet" type="text/css" />
							<script type="text/javascript" src="<?php echo base_url(); ?>file/js/jquery.flot.min.js"></script>
							
							<script type="text/javascript">
								$(document).ready(init);
								function init() {
									// example 1 - basic line graphs
									$.plot(
										$("#statistik"),
										[
											{
												label: "Statistik Pengunjung dlm 1 minggu",
												color: "#249b00",
												shadowSize: "3",
												data: [ 
													[0, <?php echo $statistik[0]['visitor']; ?>], 
													[1, <?php echo $statistik[1]['visitor']; ?>], 
													[2, <?php echo $statistik[2]['visitor']; ?>], 
													[3, <?php echo $statistik[3]['visitor']; ?>], 
													[4, <?php echo $statistik[4]['visitor']; ?>], 
													[5, <?php echo $statistik[5]['visitor']; ?>], 
													[6, <?php echo $statistik[6]['visitor']; ?>] 
												],
												lines: {show: true},
												points: {show: true},
											},
										],{
											xaxis: {
												ticks: [
												[0, "<?php echo date('d/m/Y',strtotime($statistik[0]['tanggal'])); ?>"], 
												[1, "<?php echo date('d/m/Y',strtotime($statistik[1]['tanggal'])); ?>"], 
												[2, "<?php echo date('d/m/Y',strtotime($statistik[2]['tanggal'])); ?>"], 
												[3, "<?php echo date('d/m/Y',strtotime($statistik[3]['tanggal'])); ?>"], 
												[4, "<?php echo date('d/m/Y',strtotime($statistik[4]['tanggal'])); ?>"],
												[5, "<?php echo date('d/m/Y',strtotime($statistik[5]['tanggal'])); ?>"],
												[6, "<?php echo date('d/m/Y',strtotime($statistik[6]['tanggal'])); ?>"]
												]
											},
											grid: {
												backgroundColor: "#ffffff",
											},
											legend:{
												show:false
											}
										}
									);
								}
							</script>

							<div id="statistik" class="graph-area" style="margin-left:13px;"></div>
							
						</fieldset>
						
					</div>