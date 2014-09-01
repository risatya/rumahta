
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="27%">Nama Banner</th>
										<th width="27%">posisi</th>
										<th width="30%">Status</th>
										<th width="13%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($banner_list as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $member_banner[$no-1]['nama_banner']; ?></td>
											<td><?php echo $member_banner[$no-1]['posisi']; ?></td>
											<td><?php echo ($member_banner[$no-1]['id_banner'] == null ? "available" : "not Available"); ?></td>
											<td>
												<?php echo anchor("paket_banner_manager/banner_detail/".$member_banner[$no-1]['id_info_banner'],"<i class='icon icon-eye-open'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Lihat Detail Banner")) ?>
												<?php echo ($member_banner[$no-1]['id_banner'] == null ? anchor("paket_banner_manager/set_banner/".$member_banner[$no-1]['id_info_banner'],"<i class='icon icon-bookmark'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Pasang Banner")) : "" ); ?>
											</td>
										</tr>
									<?php 
									$no++;
									endforeach; ?>
								</tbody>
							</table>
					
				</div>
			
			</div>