							
							
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="22%">Nama member</th>
										<th width="20%">Posisi Banner</th>
										<th width="22%">Besar Pembayaran</th>
										<th width="17%">Tanggal bayar</th>
										<th width="16%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($all_konfirmasi_banner as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $item->nama; ?></td>
											<td><?php echo $item->nama_banner; ?></td>
											<td><?php echo $item->besar_bayar; ?></td>
											<td><?php echo $item->tgl_bayar; ?></td>
											<td>
												<?php echo anchor("paket_banner_manager/see_konfirmasi_detail/".$item->id_konfirmasi_banner,"<i class='icon icon-eye-open'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Lihat Detail Konfirmasi")); ?>
												<?php if($item->confirmed == 0){ ?>
													<?php echo anchor("paket_banner_manager/activate/".$item->id_konfirmasi_banner,"<i class='icon icon-ok'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Aktifkan Banner")); ?>
												<?php } ?>
											</td>
										</tr>
									<?php 
									$no++;
									endforeach; ?>
								</tbody>
							</table>

				</div>
			
			</div>