			<!--attach file css -->
			<link rel="stylesheet" href="<?php echo base_url();?>file/css/jquery.mCustomScrollbar.css" type="text/css" />
			
			<!--attach file js -->
			<script src="<?php echo base_url();?>file/js/jquery.mousewheel.min.js"></script>
			<script src="<?php echo base_url();?>file/js/jquery.mCustomScrollbar.min.js"></script>
			
			<script type="text/javascript">
				$(document).ready(function () {
					$("#news_list").mCustomScrollbar({
						scrollButtons:{
							enable:true
						}
					});
					$("#testi_list").mCustomScrollbar({
						scrollButtons:{
							enable:true
						}
					});
				});
			</script>
			
			<div id="news_wrapper">
				<div id="news_title"><span><i class="icon-file icon-white"></i>&nbsp; Berita Terbaru | <?php echo anchor('page/all_news','Lihat semua berita >',array('style' => 'color:#fff')); ?></span></div>
				<div id="news_list">
				
					<?php  foreach($news as $item): ?>

						<div id="news_content_text">
							<?php echo anchor("page/news_detail/".$item->id_artikel."/".url_title($item->title),"<img src='".base_url()."file/img/news/thumb/".($item->photo_thumb != null ? $item->photo_thumb : "default_news.jpg")."' align='left' width='50px' />"); ?>
							<p><b class="judul"><?php  echo anchor("page/news_detail/".$item->id_artikel."/".url_title($item->title),substr($item->title,0,40))."..."; ?></b><br/><?php echo substr(strip_tags(html_entity_decode($item->isi)),0,80)."..."; ?></p>
						</div>
						
					<?php endforeach; ?>
				
				</div>
			</div>
			<div id="testi_wrapper">
				<div id="testi_title"><span><i class="icon-share icon-white"></i>&nbsp;Testimonial | <?php echo anchor('page/all_testimoni','Lihat semua testimoni >',array('style' => 'color:#fff')); ?></span></div>
				<div id="testi_list">
				
					<?php foreach($testimoni as $item): ?>
						<div id="testi_content_text">
							<?php echo anchor("page/testimoni_detail/".$item->id_testimoni,"<img src='".base_url()."file/img/pp/".($item->user_photo == null ? "default_pp.jpg" : $item->user_photo)."' align='left' width='50px'/>"); ?>
							<p><b class="judul"><?php echo anchor("page/testimoni_detail/".$item->id_testimoni,substr($item->nama,0,40)); ?></b><br/>
							"<?php echo substr(str_replace(array("<p>","</p>"),"",html_entity_decode($item->testimoni)),0,85); ?>"</p>
						</div>
					<?php endforeach; ?>
				
				</div>
			</div>