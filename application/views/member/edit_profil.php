					<?php 
					foreach($member_profile as $item): 
						if($item->user_photo == null){
							$photo = "default_pp.jpg";
						}
						else{
							$photo = $item->user_photo;
						}
					?>
						
					<div id="change_pp" class="modal hide fade">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Edit Foto Profil</h3>
						</div>
						<div class="modal-body">
							<?php echo form_open_multipart("member/edit_pp"); ?>
								<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $photo; ?>" class="img-polaroid" style="margin-right:10px;" align="left" />
								Upload gambar untuk mengganti foto profil anda : 
								<input class="span3" type="file" name="member_photo" />
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Edit Foto Profil</button>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
					</div>	
					
					<div id="change_password" class="modal hide fade" style="display: none; ">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h3>Edit Password</h3>
						</div>
						<div class="modal-body">
							<?php echo form_open("member/edit_password"); ?>
								Silakan masukkan password anda sebelumnya : <br/>
								<input class="span3" type="password" name="password" /> <br/><br/>
								Masukkan Password anda yang baru : <br/>
								<input class="span3" type="password" name="newpassword" />
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Edit Password</button>
							<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<?php echo form_close(); ?>
						</div>
					</div>	
				
					<script type="text/javascript">
						$('#change_pp').modal(options);
						$('#change_password').modal(options);
					 </script>
					
					<div id="inside_main_wrapper">
						<?php if($message != null){ ?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						<img src="<?php echo base_url(); ?>file/img/pp/<?php echo $photo; ?>" class="img-polaroid" style="margin-right:10px;" align="left" />
						<fieldset>
							<legend>Edit Profil</legend>
							<div class="btn-group">
							  <?php echo anchor("#change_pp","<i class='icon icon-picture'></i> Ganti Foto Profil",array("class"=>"btn","data-toggle"=>"modal")); ?>
							  <?php echo anchor("#change_password","<i class='icon icon-lock'></i> Ganti Password",array("class"=>"btn","data-toggle"=>"modal")); ?>
							</div>
							<br/>
							Isi / Ganti data - data dibawah ini untuk mengedit profil anda. <br/>
							Keterangan : Tanda * (Bintang) harus diisi.
						</fieldset>
						
						<br/><br/>
						<?php echo form_open_multipart("member/do_edit",array("class"=>"form-horizontal","name"=>"form")); ?>
						
						<fieldset>
						
						<div class="control-group">
						<label class="control-label">Nama Lengkap: </label>
						<div class="controls docs-input-sizes">
							<input class="span3" type="text" name="nama" value="<?php echo $item->nama; ?>"  />*<i><?php echo form_error('nama'); ?></i>
						</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Jenis Kelamin:</label>
							<div class="controls docs-input-sizes">
								<label class="radio inline">
									<input type="radio" name="jk" value="men" <?php if($item->jk == "men"){echo "checked";}?> /> Laki-laki &nbsp;&nbsp;&nbsp;
								  </label>
								  <label class="radio inline">
									<input type="radio" name="jk" value="women" <?php if($item->jk == "women"){echo "checked";}?> /> Perempuan
								  </label>
								  *<i><?php echo form_error('jk'); ?></i>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Email:</label>
							<div class="controls docs-input-sizes">
							  <input class="span3" type="text" name="email" value="<?php echo $item->email; ?>" />*<i><?php echo form_error('email'); ?></i>
							  <p class="help-block">Masukan email anda yang valid dan aktif.</p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">No. Handphone:</label>
							<div class="controls docs-input-sizes">
							  <input class="span3" type="text" name="nohp" value="<?php echo $item->hp; ?>" />*<i><?php echo form_error('nohp'); ?></i>
							</div>
						</div>
						  
						<div class="control-group">
							<label class="control-label">No. Telepon:</label>
							<div class="controls docs-input-sizes">
							  <input class="span2" type="text" name="notelp" value="<?php echo $item->telepon; ?>" /><i><?php echo form_error('notelp'); ?></i>
							</div>
						</div>
						  
						<div class="control-group">
							<label class="control-label">Fax:</label>
							<div class="controls docs-input-sizes">
							  <input class="span2" type="text" name="fax" value="<?php echo $item->fax; ?>" /><i><?php echo form_error('fax'); ?></i>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Alamat:</label>
							<div class="controls docs-input-sizes">
							  <textarea rows="5" class="field span4" name="alamat" style="resize:none;"><?php echo $item->alamat;?></textarea>*<i><?php echo form_error('alamat'); ?></i>
							</div>
						 </div>
						 
						<div class="control-group">
							<label class="control-label">Provinsi:</label>
							<div class="controls docs-input-sizes">
								<select name="provinsi" size="1" onchange="updateKab(this.selectedIndex)">
									<?php foreach($provinsi as $row): ?>
										<option value="<?php echo $row->id_provinsi; ?>" <?php if($item->provinsi == $row->nama_provinsi){echo "selected";} ?>><?php echo ucfirst(strtolower($row->nama_provinsi)); ?></option>
									<?php endforeach; ?>
								</select>*<i><u><?php echo form_error('provinsi'); ?></u></i>
							</div>
						</div>
						  
						<div class="control-group">
							<label class="control-label">Kabupaten/Kota:</label>
							<div class="controls docs-input-sizes">
								<select name="kab" size="1"><option value="<?php echo $item->id_kabupaten; ?>"><?php echo ucfirst(strtolower($item->kab)); ?></option></select>
								*<i><?php echo form_error('kab'); ?></i>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Mendaftar sebagai:</label>
							<div class="controls docs-input-sizes">
								<select id="register_as" name="register_as">
									<option value="individu" <?php if($item->register_as == "individu"){echo "selected"; }?>>Individu</option>
									<option value="developer" <?php if($item->register_as == "developer"){echo "selected"; }?>>Developer</option>
									<option value="agen" <?php if($item->register_as == "agen"){echo "selected"; }?>>Agen Independent</option>
									<option value="jasa" <?php if($item->register_as == "jasa"){echo "selected"; }?>>Penyedia Jasa</option>
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
						
						<?php if($item->register_as != "individu"){?>
							</fieldset>
							<fieldset>
							
							<legend>Profil Perusahaan</legend>
							
							<div class="control-group" id="company_name">
								<label class="control-label">Nama perusahaan:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="company_name" value="<?php echo $item->company_name; ?>"/>*<i><?php echo form_error('company_name'); ?></i>
								</div>
							 </div>
							 <div class="control-group" id="company_photo">
								<?php
									if($item->company_photo == null){
										$photo = "default_logo.jpg";
									}
									else{
										$photo = $item->company_photo;
									}
								?>
								<img src="<?php echo base_url(); ?>file/img/company/<?php echo $photo; ?>" class="img-polaroid" align="left" style="margin:0 10px 0 70px;width:60px;text-align : right;" />
								<div class="controls docs-input-sizes" style="margin-top : 10px;">
									Upload gambar baru jika anda ingin mengganti logo perusahaaan : 
									<input class="span3" type="file" name="company_logo" />
									<p class="help-block">*ukuran maksimum = 500 x 500px</p>
								</div>
							 </div>
						<?php } else{ ?>
							  <div class="control-group" id="company_name" style="display:none;">
								<label class="control-label">Nama perusahaan:</label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="company_name" value="<?php echo set_value('company_name'); ?>"/>*<i><?php echo form_error('company_name'); ?></i>
								</div>
							  </div>
							  <div class="control-group" id="company_photo" style="display:none;">
								<label class="control-label">Logo perusahaan:</label>
								<div class="controls docs-input-sizes">
								  <input type="file" name="company_logo" />
								   <p class="help-block">*ukuran maksimum = 500 x 500px</p>
								  <p class="help-block">Masukan logo perusahaan. apabila sebelumnya anda telah memasukkan logo perusahaan, maka logo yang lama akan terhapus secara otomatis dan diganti dengan logo baru yang anda upload.</p>
								</div>
							  </div>
						<?php } ?>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
							<button class="btn">Batal</button>
						</div>
						
						</fieldset>
						
					</div>
					<?php endforeach; ?>
			
			<script type="text/javascript">
				//document.nama_form.nama_select; 
				var provinsilist=document.form.provinsi;
				var kablist=document.form.kab;
				
				var kab=new Array();
				kab[0]='';
				<?php 
					$x = 0;
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
					if (selectedcate>=0){
						for (i=0; i<kab[selectedcate].length; i++)
						kablist.options[kablist.options.length]=new Option(kab[selectedcate][i].split('|')[0], kab[selectedcate][i].split('|')[1]);
					}
				}
				
			</script>