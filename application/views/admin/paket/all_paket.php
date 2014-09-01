							<script LANGUAGE="JavaScript">
								function confirmDelete(){
									var agree=confirm("Anda yakin ingin menghapus paket member ini ?");
									if (agree)
										return true ;
									else
										return false ;
								}
							</script>
							
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="42%">Nama Member</th>
										<th width="30%">Jenis paket</th>
										<th width="12%">Quota</th>
										<th width="13%">Aksi</th>
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
											<td><?php echo $item->quota; ?></td>
											<td>
											<?php echo anchor("paket_listing_manager/edit_paket/".$item->id_paket,"<i class='icon icon-edit'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Paket member")) ?>
											<?php echo anchor("paket_listing_manager/delete_paket/".$item->id_paket,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Hapus Paket member","onClick"=>"return confirmDelete()")) ?>
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