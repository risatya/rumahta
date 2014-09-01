				<?php foreach($banner_detail as $item): ?>
					<fieldset>
					
						<legend>
							<?php echo "Detail Banner"; ?>
							<?php //echo anchor("paket_listing_manager/activate/".$item->id_konfirmasi_listing,"Aktifkan Paket",array("class"=>"label")); ?> <br/>
						</legend>
						
						<?php echo form_open("paket_banner_manager/nonactivate/".$item->id_banner); ?>
						
						<div style="width:100%;float:left;line-height:30px;">
							<b>Posisi Banner : </b><?php echo $item->posisi; ?> <br/>
							<b>Nama User : </b> <?php echo $item->nama; ?> <br/>
							<b>Username : </b> <?php echo $item->username;  ?> <br/><br/>
							
							<b>Tanggal Publish Banner : </b> <?php echo date('d-M-Y',strtotime($item->publish_date)); ?> <br/>
							<b>Tanggal Expired : </b> <?php echo date('d-M-Y',strtotime($item->expired_date)); ?> <br/>
							
							<hr width="100%" />
							
							<b>Gambar Banner : </b> <br/>
							<img src="<?php echo base_url(); ?>file/img/banner/<?php echo $item->photo; ?>" /> <br/>
							
							<hr width="100%"/>
							
							<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
								<button type="submit" class="btn btn-primary btn-large">Hapus Banner</button>
								<button type="submit" class="btn btn-large">Kembali </button>
							</div>
							
						</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
				
				<?php endforeach; ?>
					
				</div>
			
			</div>