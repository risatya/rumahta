
					<div id="inside_main_wrapper">
						<fieldset>
							<legend>URL Member</legend>
							<?php if($message != null){ ?>
								<div class='alert alert-info'>
									<?php echo $message; ?>
								</div>
							<?php } ?>
							<p align="justify">Dengan URL member, anda dapat membuat URL khusus untuk melihat listing - listing yang anda pasang. Gunakan / pilih URL yang mudah diingat. Anda dapat mempromosikan URL singkat anda tersebut pada Kartu Nama, Brosur, Poster, Stiker,  dll.</p>
							<br/>
							Misalnya : 
							<br/><br/>
							<code>http://rumahta.com/nama_anda</code> &nbsp;&nbsp; atau &nbsp;&nbsp; <code>http://rumahta.com/nama_perusahaan</code>
							<br/><br/>
							<div class="well">
							<?php if($url == null){ ?>
								<div class="alert alert-info">
									anda belum membuat URL singkat sebelumnya.
									<br/>
									Isi form dibawah ini untuk membuat URL singkat anda : 
									<br/>
								</div>
							<?php }else{?>
								<div class="alert alert-info">
									URL singkat milik anda adalah :
									<br/>
									<code>Http://rumahta.com/<?php echo $url; ?></code>
									<br/>
									Isi form dibawah ini untuk memperbaharui / mengganti URL singkat anda : 
									<br/>
								</div>
							<?php } ?>
							<?php echo form_open("member/process_url");?>
							<div class="control-group">
								<label class="control-label">URL member (tanpa spasi):</label>
								<div class="controls">
								  <div class="input-prepend inline">
									<span class="add-on">Http://rumahta.com/</span><input class="span3" id="prependedInput" name="url" size="3" type="text" />
								  </div>
								</div>
							</div>
							<?php if($url == null){ ?>
								<button type="submit" class="btn btn-primary">Buat URL</button>
							<?php }else{?>
								<button type="submit" class="btn btn-primary">Ganti URL</button>
							<?php } ?>
							<?php echo form_close(); ?>
							
							</div>	
						</fieldset>
						<hr/>
					</div>