
					<script LANGUAGE="JavaScript">
						function confirmMarkListing1(){
							var agree=confirm("Anda yakin ingin menandai listing ini sebagai listing yang sudah terjual / tersewa ?");
							if (agree)
								return true ;
							else
								return false ;
						}
						function confirmMarkListing2(){
							var agree=confirm("Anda yakin ingin menandai listing ini sebagai listing yang belum laku ?");
							if (agree)
								return true ;
							else
								return false ;
						}
					</script>
					
					<div id="inside_main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>

						<fieldset>
							<legend>
							Daftar Listing terpasang
							<?php echo anchor("paket_listing/index","Daftar / Upgrade Paket",array("style"=>"float:right;margin-top:10px;")); ?>
							<?php echo anchor("member_listing/pilih_paket","Pasang Iklan",array("style"=>"float:right;margin-top:10px;margin-right:10px")) ?>
							</legend>
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="2%">No</th>
										<th width="44%">Judul</th>
										<th width="21%">Kategori</th>
										<th width="10%">Terjual / Tersewa</th>
										<th width="14%">Aksi</th>
										<th width="9%">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($listing as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo anchor("member_listing/listing_detail/".$item->id_listing_member,$item->judul); ?></td>
											<td><?php echo $item->nama_kategori; ?></td>
											<td>
											<?php
												if($item->laku == 1){
													if($item->status_kategori == 1){
														echo anchor("member_listing/mark_listing/0/".$item->id_listing_member,"<span class='label label-success' style='float:left;margin-top:5px'>Terjual</span>",array("title"=>"Tandai sebagai Listing belum laku","onclick" => "return confirmMarkListing2()"));
													}
													else{
														echo anchor("member_listing/mark_listing/0/".$item->id_listing_member,"<span class='label label-success' style='float:left;margin-top:5px'>Tersewa</span>",array("title"=>"Tandai sebagai Listing belum laku","onclick" => "return confirmMarkListing2()"));
													}
												}
												else{
													echo anchor("member_listing/mark_listing/1/".$item->id_listing_member,"<span class='label label-important' style='float:left;margin-top:5px'>Belum</span>",array("title"=>"Tandai sebagai Listing sudah terjual / tersewa","onclick" => "return confirmMarkListing1()"));
												}
											?>
											</td>
											<td>
											<?php
												echo anchor("member_listing/edit/".$item->id_listing_member,"<i class='icon icon-pencil'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Listing"));
												echo "&nbsp;";
												echo anchor("member_listing/delete/".$item->id_listing_member,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Hapus Listing"));
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
							<?php if($no <= 1 ){ ?>
								<div class="alert alert-info">Anda belum memasang listing.</div>
							<?php } ?>
						</fieldset>
					</div>
				