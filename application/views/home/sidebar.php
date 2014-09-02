				</div>
			</div>
			<div id="right_wrapper">
				<div id="kalkulator_wrapper">
				
					<script src="<?php echo base_url();?>file/js/calc.js" type="text/javascript"></script>
				
					<div id="kalkulator_title">
						<span>Kalkulator KPR</span>
					</div>
					<form class="kalkulator search_formstyle" >
						<div id="calc_col_1">
							Harga <br/>
							DP
						</div>
						<div id="calc_col_2">
							<input type="text" class="span2 calc" name="calc_price" id="calc_price" placeholder="ex. 100000000" />
							<input type="text" class="span2 calc" name="calc_dp" id="calc_dp" placeholder="ex. 50000000" />
						</div>
						<div id="calc_col_3">
							Tingkat suku bunga : <br/>
							Gunakan titik untuk desimal <br/>
							<input type="text" class="span1" name="calc_bunga" id="calc_bunga" /> % (Contoh: 5.7%) <br/>
							Lama Cicilan : <br/>
							<input type="text" class="span1" name="calc_cicilan" id="calc_cicilan" /> Tahun <br/>
						</div>
						<a href="#" class="btn" onclick="hitung_calc()" id="calcbtn">HITUNG</a>
						<div id="calc_line"></div>
						<div id="calc_col_4">
							Angsuran per bulan: <br/>
							<input type="text" class="span2" readonly="yes" id="hasil" name="hasil" />
							<small style="font-size:12px;"><br/>*Kalkulasi diatas hanya simulasi / estimasi biaya.</small>
						</div>
					</form>
				</div>
				<div id="side_banner">
					<?php echo anchor(($banner['side1']['url'] == null ? "#" : "http://".$banner['side1']['url']),"<img src='".base_url()."file/img/banner/".$banner['side1']['pic']."'/>",array("target" => "_blank")); ?>
				</div>
				<div id="side_banner">
					<?php echo anchor(($banner['side2']['url'] == null ? "#" : "http://".$banner['side2']['url']),"<img src='".base_url()."file/img/banner/".$banner['side2']['pic']."'/>",array("target" => "_blank")); ?>
				</div>
				<div id="side_banner">
					<?php echo anchor(($banner['side3']['url'] == null ? "#" : "http://".$banner['side3']['url']),"<img src='".base_url()."file/img/banner/".$banner['side3']['pic']."'/>",array("target" => "_blank")); ?>
				</div>
				<div id="side_banner">
					<?php echo anchor(($banner['side4']['url'] == null ? "#" : "http://".$banner['side4']['url']),"<img src='".base_url()."file/img/banner/".$banner['side4']['pic']."'/>",array("target" => "_blank")); ?>
				</div>
				<div id="side_banner">
					<?php echo anchor(($banner['side5']['url'] == null ? "#" : "http://".$banner['side5']['url']),"<img src='".base_url()."file/img/banner/".$banner['side5']['pic']."'/>",array("target" => "_blank")); ?>
				</div>
			</div>
			<div id="bottom_banner">
				<?php echo anchor(($banner['bottom1']['url'] == null ? "#" : "http://".$banner['bottom1']['url']),"<img src='".base_url()."file/img/banner/".$banner['bottom1']['pic']."'/>",array("target" => "_blank")); ?>
			</div>
			<div id="bottom_banner2">
				<?php echo anchor(($banner['bottom2']['url'] == null ? "#" : "http://".$banner['bottom2']['url']),"<img src='".base_url()."file/img/banner/".$banner['bottom2']['pic']."'/>",array("target" => "_blank")); ?>
			</div>