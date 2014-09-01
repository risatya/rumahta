				
				
				<div id="cpanel_wrapper">
						
					<h3>Edit Profil Member</h3>
					
					<div class="navbar" style="float:left;width:100%;margin-top:20px;">
					  <div class="navbar-inner">
						<form class="navbar-form pull-left">
						  <input type="text" class="span3">
						  <button type="submit" class="btn">Cari Member</button>
						</form>
					  </div>
					</div>
					
					<?php if($message != null){ ?>
						<div class='alert alert-info' style="float:left;">
							<?php echo $message; ?>
						</div>
					<?php } ?>
					
					<div id="inside_admin_wrapper" style="float : left; width : 100%;">
					<?php foreach($member as $item): ?>
					
						<?php echo form_open_multipart("member_manager/do_edit/".$item->id_user,array("class"=>"form-horizontal","name"=>"form")); ?>

							<img src="<?php echo base_url(); ?>file/img/pp/<?php echo ($item->user_photo == null || $item->user_photo == "" ? "default_pp.jpg" : $item->user_photo); ?>" class="img-polaroid" style="margin-right:10px;width:135px;" align="left" />
							
							<script LANGUAGE="JavaScript">
								function confirmDelete(){
									var agree=confirm("Anda yakin ingin menghapus member ini ?");
									if (agree)
										return true ;
									else
										return false ;
								}
							</script>

							<?php echo "<h3>".$item->username."</h3>"; ?> &nbsp;&nbsp;&nbsp;
							<?php echo anchor("member_manager/delete/".$item->id_user,"Hapus",array("class"=>"label","onClick"=>"return confirmDelete()")); ?>
							<?php echo anchor("member_manager/see_listing/".$item->id_user,"Lihat Daftar Iklan",array("class"=>"label")); ?> <br/>
							
							<hr/>

							&nbsp; <input class="span3" type="text" name="nama" value="<?php echo $item->nama; ?>"  />*<br/><br/>
							&nbsp; <input class="span3" type="text" name="email" value="<?php echo $item->email; ?>"  />*<br/><br/>
							
							<div class="control-group">
								<label class="control-label">Jenis Kelamin:</label>
								<div class="controls docs-input-sizes">
									<label class="radio inline">
										<input type="radio" name="jk" value="men" <?php if($item->jk == "men"){echo "checked";}?> /> Laki-laki &nbsp;&nbsp;&nbsp;
									  </label>
									  <label class="radio inline">
										<input type="radio" name="jk" value="women" <?php if($item->jk == "women"){echo "checked";}?> /> Perempuan
									  </label>
									  
								</div>
							</div>
							
							<div class="control-group">
							<label class="control-label">No. Handphone : </label>
								<div class="controls docs-input-sizes">
								  <input class="span3" type="text" name="nohp" value="<?php echo $item->hp; ?>" />*
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">No. Telepon:</label>
								<div class="controls docs-input-sizes">
								  <input class="span2" type="text" name="notelp" value="<?php echo $item->telepon; ?>" />
								</div>
							</div>
							  
							<div class="control-group">
								<label class="control-label">Fax:</label>
								<div class="controls docs-input-sizes">
								  <input class="span2" type="text" name="fax" value="<?php echo $item->fax; ?>" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Alamat : </label>
								<div class="controls docs-input-sizes">
								  <textarea rows="5" class="field span4" name="alamat" style="resize:none;"><?php echo $item->alamat;?></textarea>*
								</div>
							 </div>
							 
							 <div class="control-group">
								<label class="control-label">Provinsi:</label>
								<div class="controls docs-input-sizes">
									<select name="provinsi" size="1" onchange="updateKab(this.selectedIndex)">
										<?php foreach($provinsi as $row): ?>
											<option value="<?php echo $row->id_provinsi; ?>" <?php if($item->provinsi == $row->nama_provinsi){echo "selected";} ?>><?php echo ucfirst(strtolower($row->nama_provinsi)); ?></option>
										<?php endforeach; ?>
									</select>*
								</div>
							</div>
							  
							<div class="control-group">
								<label class="control-label">Kabupaten/Kota:</label>
								<div class="controls docs-input-sizes">
									<select name="kab" size="1"><option value="<?php echo $item->id_kabupaten; ?>"><?php echo ucfirst(strtolower($item->kab)); ?></option></select>
									
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
									  <input class="span3" type="text" name="company_name" value="<?php echo $item->company_name; ?>"/>*
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
										Upload gambar baru untuk mengganti logo perusahaaan : 
										<input class="span3" type="file" name="company_logo" />
									</div>
								 </div>
							<?php } else{ ?>
								  <div class="control-group" id="company_name" style="display:none;">
									<label class="control-label">Nama perusahaan:</label>
									<div class="controls docs-input-sizes">
									  <input class="span3" type="text" name="company_name" value="<?php echo set_value('company_name'); ?>"/>*
									</div>
								  </div>
								  <div class="control-group" id="company_photo" style="display:none;">
									<label class="control-label">Logo perusahaan:</label>
									<div class="controls docs-input-sizes">
									  <input type="file" name="company_logo" />
									  <p class="help-block">Masukan logo perusahaan. apabila sebelumnya anda telah memasukkan logo perusahaan, maka logo yang lama akan terhapus secara otomatis dan diganti dengan logo baru yang anda upload.</p>
									</div>
								  </div>
							<?php } ?>
							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
								<button class="btn" onclick="history.go(-1)">Batal</button>
							</div>

						<?php echo form_close(); ?>
					
					<?php endforeach; ?>
					</div>
					
				</div>
					
			</div>