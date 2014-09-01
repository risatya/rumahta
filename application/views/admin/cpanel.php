				
				
				<div id="cpanel_wrapper">
						
					<h3>Selamat Datang</h3>
					
					
					<link href="<?php echo base_url(); ?>file/css/flotstyle.css" rel="stylesheet" type="text/css" />
					<script type="text/javascript" src="<?php echo base_url(); ?>file/js/jquery.flot.min.js"></script>
					
					<script type="text/javascript">
						$(document).ready(init);
						function init() {
							// example 1 - basic line graphs
							$.plot(
								$("#admin_statistik"),
								[
									{
										label: "Pemasangan iklan listing",
										color: "#249b00",
										shadowSize: "3",
										data: [ 
											[0, <?php echo $statistik[0]['listing']; ?>], 
											[1, <?php echo $statistik[1]['listing']; ?>], 
											[2, <?php echo $statistik[2]['listing']; ?>], 
											[3, <?php echo $statistik[3]['listing']; ?>], 
											[4, <?php echo $statistik[4]['listing']; ?>], 
											[5, <?php echo $statistik[5]['listing']; ?>], 
											[6, <?php echo $statistik[6]['listing']; ?>],
											[7, <?php echo $statistik[7]['listing']; ?>], 
											[8, <?php echo $statistik[8]['listing']; ?>], 
											[9, <?php echo $statistik[9]['listing']; ?>], 
											[10, <?php echo $statistik[10]['listing']; ?>],
											[11, <?php echo $statistik[11]['listing']; ?>] 
										],
										lines: {show: true},
										points: {show: true},
									},
									{
										label: "Pendaftaran User Baru",
										color: "#0085da",
										shadowSize: "3",
										data: [ 
											[0, <?php echo $statistik[0]['member']; ?>], 
											[1, <?php echo $statistik[1]['member']; ?>], 
											[2, <?php echo $statistik[2]['member']; ?>], 
											[3, <?php echo $statistik[3]['member']; ?>], 
											[4, <?php echo $statistik[4]['member']; ?>], 
											[5, <?php echo $statistik[5]['member']; ?>], 
											[6, <?php echo $statistik[6]['member']; ?>],
											[7, <?php echo $statistik[7]['member']; ?>], 
											[8, <?php echo $statistik[8]['member']; ?>], 
											[9, <?php echo $statistik[9]['member']; ?>], 
											[10, <?php echo $statistik[10]['member']; ?>], 
											[11, <?php echo $statistik[11]['member']; ?>] 
										],
										lines: {show: true},
										points: {show: true},
									}
								],{
									xaxis: {
										ticks: [
										[0, "<?php echo date('d M',strtotime($statistik[0]['tanggal'])); ?>"], 
										[1, "<?php echo date('d M',strtotime($statistik[1]['tanggal'])); ?>"], 
										[2, "<?php echo date('d M',strtotime($statistik[2]['tanggal'])); ?>"], 
										[3, "<?php echo date('d M',strtotime($statistik[3]['tanggal'])); ?>"], 
										[4, "<?php echo date('d M',strtotime($statistik[4]['tanggal'])); ?>"],
										[5, "<?php echo date('d M',strtotime($statistik[5]['tanggal'])); ?>"],
										[6, "<?php echo date('d M',strtotime($statistik[6]['tanggal'])); ?>"],
										[7, "<?php echo date('d M',strtotime($statistik[7]['tanggal'])); ?>"],
										[8, "<?php echo date('d M',strtotime($statistik[8]['tanggal'])); ?>"],
										[9, "<?php echo date('d M',strtotime($statistik[9]['tanggal'])); ?>"],
										[10, "<?php echo date('d M',strtotime($statistik[10]['tanggal'])); ?>"],
										[11, "<?php echo date('d M',strtotime($statistik[11]['tanggal'])); ?>"]
										]
									},
									grid: {
										backgroundColor: "#ffffff",
									},
									legend:{
										show:true
									}
								}
							);
						}
					</script>

					<div id="admin_statistik" class="graph-area2"></div>
					
					<div class='alert alert-info' style="margin-top:20px;">
						<?php echo $statistik[11]['member']." Member baru mendaftar dan ".$statistik[11]['listing']." Listing dipasang hari ini."; ?>
					</div>
					
				</div>
					
			</div>