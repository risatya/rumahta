			<div id="cpanel_wrapper">
						
				<div style="width:100%;float:left;margin-top:20px">
				
						<fieldset>
							
							<legend>Testimoni Manager</legend>
							
							<?php if($message != null){ ?>
								<div class='alert alert-info' style="float:left">
									<?php echo $message; ?>
								</div>
							<?php } ?>
						
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="20%">User</th>
										<th width="54%">Testimoni</th>
										<th width="10%">Status</th>
										<th width="13%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach($all_testi as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $item->username; ?></td>
											<td><?php echo substr(str_replace(array("<p>","</p>"),"",html_entity_decode($item->testimoni)),0,85)."..."; ?></td>
											<td><?php echo ($item->status_testi == 1 ? anchor("testimoni_manager/nonactivate/".$item->id_testimoni,"<span class='label label-success' style='float:left;margin-top:5px'>Aktif</span>",array('title' => 'Nonaktifkan testimoni')) : anchor("testimoni_manager/activate/".$item->id_testimoni,"<span class='label label-important' style='float:left;margin-top:5px'>Tidak aktif</span>",array('title' => 'Aktifkan testimoni'))); ?></td>
											<td><?php 
												
												echo ($item->status_testi == 1 ? anchor("testimoni_manager/nonactivate/".$item->id_testimoni,"<i class='icon icon-minus' style='float:left;margin-top:5px'></i>",array('title' => 'Nonaktifkan testimoni',"class"=>"btn btn-small","style"=>"width:12px;")) : anchor("testimoni_manager/activate/".$item->id_testimoni,"<i class='icon icon-ok' style='float:left;margin-top:5px'></i>",array('title' => 'Aktifkan testimoni','class' => 'btn',"class"=>"btn btn-small","style"=>"width:12px;")));
												echo "&nbsp;";
												echo anchor("#","<i class='icon icon-remove' style='float:left;margin-top:5px'></i>",array('title' => 'Hapus testimoni',"class"=>"btn btn-small","style"=>"width:12px;"))
												
											?></td>
										</tr>
									<?php $no++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
							
						</fieldset>
					
				</div>
			
			</div>