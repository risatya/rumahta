							
							
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="22%">Nama member</th>
										<th width="20%">Jenis paket</th>
										<th width="22%">Besar Pembayaran</th>
										<th width="17%">Tanggal bayar</th>
										<th width="16%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($all_paket as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $item->nama; ?></td>
											<td><?php echo $item->nama_paket; ?></td>
											<td><?php echo $item->besar_bayar; ?></td>
											<td><?php echo $item->tgl_bayar; ?></td>
											<td>
												<?php echo anchor("paket_listing_manager/see_konfirmasi_detail/".$item->id_konfirmasi_listing,"<i class='icon icon-eye-open'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Lihat Detail Konfirmasi")); ?>
												<?php if($item->confirmed == 0){ ?>
													<?php echo anchor("paket_listing_manager/activate/".$item->id_konfirmasi_listing,"<i class='icon icon-ok'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Aktifkan Paket Listing")); ?>
												<?php } ?>
											</td>
										</tr>
									<?php 
									$no++;
									endforeach; ?>
								</tbody>
							</table>
							
						<p class="listing_paging" ><?php echo $this->pagination->create_links(); ?> </p>
					
				</div>
			
			</div>