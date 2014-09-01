
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="42%">Judul</th>
										<th width="30%">Kategori</th>
										<th width="13%">Aksi</th>
										<th width="12%">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($listing as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo anchor("listing_manager/listing_detail/".$item->id_listing_member,$item->judul); ?></td>
											<td><?php echo $item->nama_kategori; ?></td>
											<td>
											<?php
												echo anchor("listing_manager/edit_listing/".$item->id_listing_member,"<i class='icon icon-pencil'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Listing"));
												echo "&nbsp;";
												echo anchor("listing_manager/delete_listing/".$item->id_listing_member,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Hapus Listing"));
											?>
											</td>
											<td>
											<?php
												$now = strtotime(date('Y-m-d'));
												$exp = strtotime($item->expired_date);
												if($now <= $exp){
													echo "<span class='label label-success' style='float:left;margin-top:5px'>Aktif</span>";
												}
												else{
													echo "<span class='label label-important' style='float:left;margin-top:5px'>Expired</span>";
												}
											?>
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