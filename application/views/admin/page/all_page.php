			<div id="cpanel_wrapper">
						
				<div style="width:100%;float:left;margin-top:20px">
				
						<fieldset>
							
							<legend>Page Manager</legend>
							
							<?php if($message != null){ ?>
								<div class='alert alert-info' style="float:left;width:92%">
									<?php echo $message; ?>
								</div>
							<?php } ?>
							
							<?php
							
								echo anchor("page_manager/new_page","Buat Halaman Baru",array("class" => "btn btn-primary btn-large"))."<br/><br/>";
							
							?>
								
							<script LANGUAGE="JavaScript">
								function confirmDelete(){
									var agree=confirm("Anda yakin ingin menghapus halaman ini ?");
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
										<th width="39%">Nama Halaman</th>
										<th width="39%">Judul</th>
										<th width="3%">ID</th>
										<th width="15%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach($page_list as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo anchor("page_manager/page_detail/".$item->id_page,$item->nama); ?></td>
											<td><?php echo anchor("page_manager/page_detail/".$item->id_page,$item->title); ?></td>
											<td><?php echo $item->id_page; ?></td>
											<td><?php 
												
												echo anchor("page_manager/edit/".$item->id_page,"<i class='icon icon-edit' style='float:left;margin-top:5px'></i>",array('title' => 'Edit halaman',"class"=>"btn btn-small","style"=>"width:12px;"));
												echo "&nbsp;";
												echo anchor("page_manager/delete/".$item->id_page,"<i class='icon icon-remove' style='float:left;margin-top:5px'></i>",array('title' => 'Hapus halaman',"class"=>"btn btn-small","style"=>"width:12px;","onClick"=>"return confirmDelete()"));
												
											?></td>
										</tr>
									<?php $no++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
							
						</fieldset>
					
				</div>
			
			</div>