
					<div id="inside_main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
							<legend>Statistik Pengunjung Listing Anda</legend>
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
						
						<fieldset style="margin-top:20px;">
							<legend>
							Lihat Statistik Tiap Listing
							</legend>
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="74%">Iklan</th>
										<th width="23%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($listing as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td>
											<?php echo $item->judul; ?>
											</td>
											<td>
											<?php
												echo anchor("statistik/listing/".$item->id_listing_member,"<i class='icon icon-tasks'></i> Lihat Statistik",array("class"=>"btn"));
											?>
											</td>
										</tr>
									<?php 
									$no++;
									endforeach; ?>
								</tbody>
							</table>
							<?php if($no <= 1 ){ ?>
								<div class="alert alert-info">Anda belum memasang listing.</div>
							<?php } ?>
						</fieldset>
					</div>
				