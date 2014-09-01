			<div id="cpanel_wrapper">
						
				<div style="width:100%;float:left;margin-top:20px">
				
						<fieldset>
							
							<legend>Berita Website</legend>
							
							<?php if($message != null){ ?>
								<div class='alert alert-info' style="float:left;width:92%">
									<?php echo $message; ?>
								</div>
							<?php } ?>
							
							<?php
							
								echo anchor("news_manager/new_news","Buat Berita",array("class" => "btn btn-primary btn-large"))."<br/><br/>";
							
							?>
								
							<script LANGUAGE="JavaScript">
								function confirmDelete(){
									var agree=confirm("Anda yakin ingin menghapus berita ini ?");
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
										<th width="39%">Judul</th>
										<th width="18%">Tanggal Terbit</th>
										<th width="18%">Status</th>
										<th width="12%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach($news_list as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo anchor("news_manager/news_detail/".$item->id_artikel,$item->title); ?></td>
											<td><?php echo date('d-M-Y',strtotime($item->tanggal)); ?></td>
											<td><?php echo ($item->status == 1 ? anchor("news_manager/nonactivate/".$item->id_artikel,"<span class='label label-success' style='float:left;margin-top:5px'>Aktif</span>",array('title' => 'Nonaktifkan berita')) : anchor("news_manager/activate/".$item->id_artikel,"<span class='label label-important' style='float:left;margin-top:5px'>Tidak aktif</span>",array('title' => 'Aktifkan berita'))); ?></td>
											<td><?php 
												
												echo anchor("news_manager/edit/".$item->id_artikel,"<i class='icon icon-edit' style='float:left;margin-top:5px'></i>",array('title' => 'Edit berita',"class"=>"btn btn-small","style"=>"width:12px;"));
												echo "&nbsp;";
												echo anchor("news_manager/delete/".$item->id_artikel,"<i class='icon icon-remove' style='float:left;margin-top:5px'></i>",array('title' => 'Hapus berita',"class"=>"btn btn-small","style"=>"width:12px;","onClick"=>"return confirmDelete()"));
												
											?></td>
										</tr>
									<?php $no++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
							
						</fieldset>
					
				</div>
			
			</div>