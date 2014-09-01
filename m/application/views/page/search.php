
	<h3>Pencarian cepat : </h3> <br/><br/>

	<div data-role="content" class="container ui-content" role="main">	
	
		<?php echo form_open("page/search"); ?>

			<input type="text" name="keyword" value="" placeholder="Masukan kata kunci"/>
			
			<select name="location" data-mini="true">
				<option value="">Lokasi (semua)</option>
				<?php foreach($kabupaten as $item):?>
					<option value="<?php echo $item->id_kabupaten?>"><?php echo ucfirst(strtolower($item->nama_kabupaten)); ?></option>
				<?php endforeach;?>
			</select>
			
			<select name="category" data-mini="true">
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
			
			<fieldset data-role="controlgroup" data-mini="true">
				<legend>Status:</legend>
				<input type="radio" name="status" id="radio-mini-1" value="3" checked="checked" />
				<label for="radio-mini-1">Dijual &amp; Disewakan</label>

				<input type="radio" name="status" id="radio-mini-2" value="1"  />
				<label for="radio-mini-2">Dijual</label>
				
				<input type="radio" name="status" id="radio-mini-3" value="2"  />
				<label for="radio-mini-3">Disewakan</label>
			</fieldset>
			
			<div data-role="fieldcontain">
				<label for="ktidur">Kamar tidur:</label>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<select id="kamar_tidur" name="kamar_tidur_min" data-mini="true">
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
					</div>
					<div class="ui-block-b">
						<select id="kamar_tidur" name="kamar_tidur_max" data-mini="true">
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
					</div>
				</div><!-- /grid-a -->
			</div>
			
			<div data-role="fieldcontain">
				<label for="kmandi">Kamar mandi:</label>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<select id="kamar_mandi" name="kamar_mandi_min" data-mini="true">
							<option value="">min</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="ui-block-b">
						<select id="kamar_mandi" name="kamar_mandi_max" data-mini="true">
							<option value="">max</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div><!-- /grid-a -->
			</div>
			
			<div data-role="fieldcontain">
				<label for="lbangunan">Luas Bangunan:</label>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<select id="lbangunan" name="lbangunan_min" data-mini="true">
							<option value="">min</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
						</select>
					</div>
					<div class="ui-block-b">
						<select id="lbangunan" name="lbangunan_max" data-mini="true">
							<option value="">max</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
							<option value="2000">2000 m2</option>
						</select>
					</div>
				</div><!-- /grid-a -->
			</div>
			
			<div data-role="fieldcontain">
				<label for="ltanah">Luas Tanah:</label>
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<select id="ltanah" name="ltanah_min" data-mini="true">
							<option value="">min</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
						</select>
					</div>
					<div class="ui-block-b">
						<select id="ltanah" name="ltanah_max" data-mini="true">
							<option value="">max</option>
							<option value="50">50 m2</option>
							<option value="100">100 m2</option>
							<option value="250">250 m2</option>
							<option value="500">500 m2</option>
							<option value="1000">1000 m2</option>
							<option value="2000">2000 m2</option>
						</select>
					</div>
				</div><!-- /grid-a -->
			</div>
			
			<input type="submit" data-theme="a" data-role="button" value="Cari Listing" />
			
		<?php echo form_close(); ?>
		
	</div>
