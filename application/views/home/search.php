		<script type="text/javascript">
        $(document).ready(function () {
			$('.kriteria').click(function() {
				$('#kriteria_tambahan').toggle();
			});
		});
		</script>
		
		<div id="search_wrapper">
			<div id="search_title">
				<span>Pencarian Cepat</span>
			</div>
			<?php echo form_open("page/search",array('id' => 'search_form')); ?>
				<!--<img src="<?php echo base_url(); ?>file/img/icon_search.png" />-->
				<input type="text" id="keyword" class="span4" name="keyword" placeholder="Kata Kunci" />
				<select id="location" name="location">
					<option value="">Lokasi (semua)</option>
					<?php foreach($kabupaten as $item):?>
						<option value="<?php echo $item->id_kabupaten?>"><?php echo ucfirst(strtolower($item->nama_kabupaten)); ?></option>
					<?php endforeach;?>
				</select>
				<select id="category" name="category">
					<option value="">Kategori (semua)</option>
					<option value="1">Rumah</option>
					<option value="2">Apartemen</option>
					<option value="3">Tanah</option>
					<option value="4">Ruko/Rukan</option>
					<option value="5">Kios</option>
					<option value="6">Gudang/Pabrik</option>
					<option value="7">Jasa</option>
					<option value="8">Indekost</option>
				</select>
				<span class="kriteria">Kriteria Tambahan &nbsp;&nbsp;</span> <img src="<?php echo base_url(); ?>file/img/arrow_down.png" style="float:left;margin : 20px 0 0 -5px;"/>
				<div id="form_line"></div>
				<div id="kriteria_tambahan">
					<div id="form_col_1" class="search_formstyle">
						Status :
					</div>
					<div id="form_col_2" class="search_formstyle">
						<input type="radio" name="status" value="3" /> Dijual & Disewakan <br/>
						<input type="radio" name="status" value="1" /> Dijual <br/>
						<input type="radio" name="status" value="2" /> Disewakan					
					</div>
					<div id="form_col_3" class="search_formstyle">
						Kmr Tidur:<br/>
						Kmr Mandi:
					</div>
					<div id="form_col_4" class="search_formstyle">
						<select id="kamar_tidur" name="kamar_tidur_min">
							<option value="">min</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
						-
						<select id="kamar_tidur" name="kamar_tidur_max">
							<option value="">max</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
						<br/>
						<select id="kamar_mandi" name="kamar_mandi_min">
							<option value="">min</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						-
						<select id="kamar_mandi" name="kamar_mandi_max">
							<option value="">max</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div id="form_col_5" class="search_formstyle">
						L Bangunan:<br/>
						Luas Tanah:
						<!--<input type="text" name="min_price" class="span1" placeholder="Min" />
						s/d 
						<input type="text" name="max_price" class="span1" placeholder="Max" />-->
					</div>
					<div id="form_col_6" class="search_formstyle">
						<select id="lbangunan" name="lbangunan_min">
							<option value="">min</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
						</select>
						-
						<select id="lbangunan" name="lbangunan_max">
							<option value="">max</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
							<option value="2000">2000 m2</option>
						</select>
						<br/>
						<select id="ltanah" name="ltanah_min">
							<option value="">min</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
						</select>
						-
						<select id="ltanah" name="ltanah_max">
							<option value="">max</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
							<option value="2000">2000 m2</option>
						</select>
					</div>
				</div>
				<div id="form_col_7" class="search_formstyle">
					<input type="submit" class="btn" name="submit" id="search_btn" value="CARI"/>
				</div>
			<?php echo form_close(); ?>
		</div>