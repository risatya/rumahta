				<?php foreach($konfirmasi_detail as $item): ?>
					<fieldset>
					
						<legend>
							<?php echo "konfirmasi pembayaran ".$item->nama_banner; ?>
							<?php //echo anchor("paket_listing_manager/activate/".$item->id_konfirmasi_listing,"Aktifkan Paket",array("class"=>"label")); ?> <br/>
						</legend>
						
						<script LANGUAGE="JavaScript">
							function confirmDelete(){
								var agree=confirm("Aktifkan Banner ?");
								if (agree)
									return true ;
								else
									return false ;
							}
						</script>
						
						<?php echo form_open("paket_banner_manager/activate/".$item->id_konfirmasi_banner); ?>
						
						<div style="width:100%;float:left;line-height:30px;">
							<b>Nama : </b><?php echo ($item->nama == null ? "-" : $item->nama); ?><br/>
							<b>Username : </b><?php echo ($item->username == null ? "-" : $item->username); ?><br/>
							<b>Nama Paket : </b><?php echo ($item->nama_banner == null ? "-" : $item->nama_banner); ?><br/>
							<b>Durasi Banner : </b><?php echo ($item->durasi == null ? "-" : $item->durasi)." bulan."; ?><br/>
							<b>Harga Banner : </b><?php echo ($item->harga == null ? "-" : "Rp. ".$item->harga); ?><br/><br/>
							
							<b>Tanggal Pembayaran : </b><?php echo ($item->tgl_bayar == null ? "-" : $item->tgl_bayar); ?><br/>
							<b>Sistem Pembayaran : </b><?php echo ($item->sistem == 1 ? "Transfer" : "Tunai"); ?><br/>
							<b>Besar Pembayaran : </b><?php echo ($item->besar_bayar == null ? "-" : $item->besar_bayar); ?><br/>
							<?php if($item->sistem == 1){ ?>
								<b>Bank asal : </b><?php echo ($item->bank_asal == null ? "-" : $item->bank_asal); ?><br/>
								<b>Bank Tujuan : </b><?php echo ($item->bank_tujuan == null ? "-" : $item->bank_tujuan); ?><br/><br/>
							<?php } ?>
						</div>
						
						<?php echo form_close(); ?>
						
					</fieldset>
					
					<fieldset>

						<legend>Foto Banner</legend>
						
						<img src="<?php echo base_url(); ?>file/img/banner/<?php echo $item->photo; ?>" />
						
						<?php if($item->confirmed != null){ ?>
								<div class="control-group" style="width:100%;float:left;margin:25px 0 0 230px">
									<?php //echo anchor('paket_banner_manager/activate/'.$item->) ?>
									<input type="submit" class="btn btn-primary btn-large" onclick="return confirmDelete()" >Aktifkan Paket</button>
									<button type="button" class="btn btn-large" onclick="history.go(-1)">Cancel</button>
								</div>
							<?php } ?>
						
					</fieldset>
				
				<?php endforeach; ?>
					
				</div>
			
			</div>