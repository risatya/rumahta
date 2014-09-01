					<link href="<?php echo base_url(); ?>file/css/flotstyle.css" rel="stylesheet" type="text/css" />
					<script type="text/javascript" src="<?php echo base_url(); ?>file/js/jquery.flot.min.js"></script>
					
					<script type="text/javascript">
						$(document).ready(init);
						function init() {
							// example 1 - basic line graphs
							$.plot(
								$("#statistik1"),
								[
									{
										label: "Jumlah Listing yang Terpasang",
										color: "#249b00",
										shadowSize: "3",
										data: [ 
										<?php
										for($x = 0 ; $x <= 11 ; $x++){
											echo "[".$x.",".$statistik[$x]['listing']."],";
										}
										?>	
										],
										lines: {show: true},
										points: {show: true},
									}
								],{
									xaxis: {
										ticks: [
										<?php
										for($x = 0 ; $x <= 11 ; $x++){
											echo "[".$x.",'".date('M Y',strtotime($statistik[$x]['tanggal']))."'],";
										}
										?>
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
							$.plot(
								$("#statistik2"),
								[
									{
										label: "Jumlah Listing Yang Laku",
										color: "#0085da",
										shadowSize: "3",
										data: [ 
										<?php
										for($x = 0 ; $x <= 11 ; $x++){
											echo "[".$x.",".$statistik2[$x]['listing']."],";
										}
										?>	
										],
										lines: {show: true},
										points: {show: true},
									}
								],{
									xaxis: {
										ticks: [
										<?php
										for($x = 0 ; $x <= 11 ; $x++){
											echo "[".$x.",'".date('M Y',strtotime($statistik2[$x]['tanggal']))."'],";
										}
										?>
										]
									},
									yaxis: {
										tickDecimals: 0
									},
									grid: {
										backgroundColor: "#ffffff",
									},
									legend:{
										show:true
									}
								}
							);
							$.plot(
								$("#statistik3"),
								[
									{
										label: "Jumlah Pengunjung Rumahta.com",
										color: "#bf0b57",
										shadowSize: "3",
										data: [ 
										<?php
										for($x = 0 ; $x <= 11 ; $x++){
											echo "[".$x.",".$statistik3[$x]['visitor']."],";
										}
										?>	
										],
										lines: {show: true},
										points: {show: true},
									}
								],{
									xaxis: {
										ticks: [
										<?php
										for($x = 0 ; $x <= 11 ; $x++){
											echo "[".$x.",'".date('d M',strtotime($statistik3[$x]['tanggal']))."'],";
										}
										?>
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
					
					<div id="main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset style="margin-bottom:10px">
							
							<legend>Statistik Website</legend>
							
							<blockquote>
							<b>Statistik Listing yang Terpasang</b>
							<small>Berikut adalah statistik jumlah listing yang dipasang dalam rumahta.com per bulannya.</small>
							</blockquote>
							
							<p style="position:absolute;margin : 100px 0 0 20px;text-align:right"><b>Jumlah<br/>Listing</b></p>
							<div id="statistik1" class="graph-area2" style="width:550px;margin : 0px 0 0 90px">
							</div>
							<br/><br/>
							
							<blockquote>
							<b>Statistik Listing yang Laku</b>
							<small>Berikut adalah statistik jumlah listing yang laku (telah terjual / tersewa) dalam rumahta.com per bulannya.</small>
							</blockquote>
							
							<p style="position:absolute;margin : 100px 0 0 20px;text-align:right"><b>Jumlah<br/>Listing<br/>Laku</b></p>
							<div id="statistik2" class="graph-area2" style="width:550px;margin : 0px 0 0 90px"></div>
							<br/><br/>
							
							<blockquote>
							<b>Statistik Pengunjung rumahta.com</b>
							<small>Berikut adalah statistik jumlah pengunjung rumahta.com per harinya.</small>
							</blockquote>
							
							<p style="position:absolute;margin : 100px 0 0 0px;text-align:right"><b>Jumlah<br/>Pengunjung</b></p>
							<div id="statistik3" class="graph-area2" style="width:550px;margin : 0px 0 0 90px"></div>
							<br/><br/>
						
						</fieldset>	