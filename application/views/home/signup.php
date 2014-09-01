				<div id="main_wrapper">
					<div id="main_title">
						<span>Pendaftaran Member</span>
					</div>
					
					<p width="100%" style="float : left;"><small>Untuk dapat memasang iklan anda harus mendaftar terlebih dahulu sebagai member, silakan isi formulir dibawah ini. <br/><font color="red">Tanda * (bintang) harus diisi.</font><small></p>
					<div id="main_line"></div>
					<div id="signup_form">
						<?php echo form_open_multipart("home/validate_signup/".$captcha['key'],array("class"=>"form-horizontal","name"=>"form")); ?>
							<fieldset>
							  <?php if($message!=null){ echo "<div class='alert alert-block'>".$message."</div>"; } ?>
							  <div class="control-group">
								<label class="control-label">Username:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="username" value="<?php echo set_value('username'); ?>" />*<i><?php echo form_error('username'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Password:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="password" name="password" value="<?php echo set_value('password'); ?>" />*<i><?php echo form_error('password'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Ulangi Password:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="password" name="password2" />
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Nama Lengkap:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="nama" value="<?php echo set_value('nama'); ?>"  />*<i><?php echo form_error('nama'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Email:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="email" value="<?php echo set_value('email'); ?>" />*<i><?php echo form_error('email'); ?></i>
								  <p class="help-block">Masukan email anda yang valid dan aktif, karena kami akan mengirimkan link konfirmasi untuk mengaktifkan akun anda.</p>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Jenis Kelamin:</label>
								<div class="controls docs-input-sizes">
									<label class="radio inline">
										<input type="radio" name="jk" value="men" checked /> Laki-laki &nbsp;&nbsp;&nbsp;
									  </label>
									  <label class="radio inline">
										<input type="radio" name="jk" value="women" /> Perempuan
									  </label>
									  *<i><?php echo form_error('jk'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">No. Handphone:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="nohp" value="<?php echo set_value('nohp'); ?>" />*<i><?php echo form_error('nohp'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">No. Telepon:</label>
								<div class="controls docs-input-sizes">
								  <input class="span2" type="text" name="notelp" value="<?php echo set_value('notelp'); ?>" /><i><?php echo form_error('notelp'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Fax:</label>
								<div class="controls docs-input-sizes">
								  <input class="span2" type="text" name="fax" value="<?php echo set_value('fax'); ?>" /><i><?php echo form_error('fax'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Mendaftar sebagai:</label>
								<div class="controls docs-input-sizes">
									<select id="register_as" name="register_as">
										<option value="individu">Individu</option>
										<option value="developer">Developer</option>
										<option value="agen">Agen Independent</option>
										<option value="jasa">Penyedia Jasa</option>
									</select>
								</div>
							  </div>
							  
							  <script type="text/javascript">
								$(document).ready(function(){
									$("#register_as").change(function(){
										if(this.value != "individu"){
											$("#company_name,#company_photo").show();
										}
										else{
											$("#company_name,#company_photo").hide();
										}
									});
								});
							  </script>
							  
							  <div class="control-group" id="company_name" style="display:none;">
								<label class="control-label">Nama perusahaan:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="company_name" value="<?php echo set_value('company_name'); ?>"/>*<i><?php echo form_error('company_name'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Alamat:</label>
								<div class="controls docs-input-sizes">
								  <textarea rows="5" class="field span4" name="alamat" style="resize:none;"><?php echo set_value('alamat');?></textarea>*<i><?php echo form_error('alamat'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Provinsi:</label>
								<div class="controls docs-input-sizes">
								  <!--<input class="span3" type="text" name="provinsi" value="<?php //echo set_value('provinsi'); ?>" />*<i><?php //echo form_error('provinsi'); ?></i>-->
								  <select name="provinsi" size="1" onchange="updateKab(this.selectedIndex)">
										<option value="" selected>Pilih provinsi</option>
										<?php foreach($provinsi as $item): ?>
											<option value="<?php echo $item->id_provinsi; ?>"><?php echo ucfirst(strtolower($item->nama_provinsi)); ?></option>
										<?php endforeach; ?>
									</select>*<i><u><?php echo form_error('provinsi'); ?></u></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Kabupaten/Kota:</label>
								<div class="controls docs-input-sizes">
									<select name="kab" size="1"><option value="">Pilih kabupaten</option></select>
									*<i><?php echo form_error('kab'); ?></i>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Foto (Profil Picture):</label>
								<div class="controls docs-input-sizes">
								  <input type="file" name="member_photo" />
								   <p class="help-block">*ukuran maksimum = 500 x 500px</p>
								</div>
							  </div>
							  
							  <div class="control-group" id="company_photo" style="display:none;">
								<label class="control-label">Logo perusahaan:</label>
								<div class="controls docs-input-sizes">
								  <input type="file" name="company_logo" />
								   <p class="help-block">*ukuran maksimum = 500 x 500px</p>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Verifikasi:</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on"><?php echo $captcha["text"]; ?> = </span><input class="span1" id="prependedInput" name="answer" size="3" type="text" />
								  </div>
								  <p class="help-block">Silakan isikan jawaban dari soal diatas dengan benar.</p>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="inlineCheckboxes">Persetujuan:</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" name="agree" value="yes"> Saya menyetujui semua <a data-toggle="modal" href="#web_term">Aturan dan ketentuan</a> yang berlaku di rumahta.com
								  </label>
								</div>
							  </div>
							  
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Daftar sekarang</button>
								<button class="btn">Cancel</button>
							  </div>
							  
							  <script type="text/javascript">
								$('#web_term').modal(options);
							  </script>
							  <div id="web_term" class="modal hide fade" style="display: none; ">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">×</button>
										  <h3>Peraturan dan Ketentuan Rumahta.com</h3>
										</div>
										<div class="modal-body">
										  <?php foreach($copyright as $text): ?>
											<?php echo html_entity_decode($text->content); ?>
										  <?php endforeach; ?>
										</div>
										<div class="modal-footer">
										  Copyright &copy; 2012 Rumahta.com
										</div>
							  </div>
							</fieldset>
						<?php echo form_close(); ?>
					</div>
			
			<script type="text/javascript">
				//document.nama_form.nama_select; 
				var provinsilist=document.form.provinsi;
				var kablist=document.form.kab;
				
				var kab=new Array();
				kab[0]='';
				<?php 
					$x = 1;
					foreach($provinsi as $item): 
						echo "kab[".$x."]=["; 
						foreach($kabupaten as $row): 
							if($item->id_provinsi == $row->id_provinsi){
								echo "'".ucfirst(strtolower($row->nama_kabupaten))."|".$row->id_kabupaten."'," ;
							} 
						endforeach;
						echo "];" ;
						$x++; 
					endforeach;  
				?>
				
				function updateKab(selectedcate){
					kablist.options.length=0;
					if (selectedcate>0){
						for (i=0; i<kab[selectedcate].length; i++)
						kablist.options[kablist.options.length]=new Option(kab[selectedcate][i].split('|')[0], kab[selectedcate][i].split('|')[1]);
					}
				}
				
			</script>