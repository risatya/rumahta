
					<div id="inside_main_wrapper">
						<?php if($message != null){?>
							<div class='alert alert-info'>
								<?php echo $message; ?>
							</div>
						<?php } ?>
						
						<fieldset>
							<legend>
							Daftar Testimoni Anda
							<?php echo anchor("testimoni/index","Buat Testimoni",array("style"=>"float:right;margin-top:10px;")); ?>
							</legend>
							<table class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th width="60%">Testimoni</th>
										<th width="20%">Tanggal</th>
										<th width="17%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($testi as $item): ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td>
											<?php 
												$str = html_entity_decode($item->testimoni);
												echo anchor("testimoni/testi_detail/".$item->id_testimoni,(strlen($str) > 55 ? substr($str,0,55)." ...." : $str)); 
											?>
											</td>
											<td>
											<?php
												echo date('d-M-Y',strtotime($item->tanggal));
											?>
											</td>
											<td>
											<?php
												echo anchor("testimoni/edit/".$item->id_testimoni,"<i class='icon icon-pencil'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Edit Testimoni"));
												echo "&nbsp;";
												echo anchor("testimoni/delete/".$item->id_testimoni,"<i class='icon icon-remove'></i>",array("class"=>"btn btn-small","style"=>"width:12px;","title"=>"Hapus Testimoni"));
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
				