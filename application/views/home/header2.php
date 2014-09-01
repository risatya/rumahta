<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<title><?= ($page_title != null ? $page_title : "Rumahta.com | Jual, Beli, Sewa, Rumah, Kostan, Tanah, Tempat Usaha di Sulawesi Selatan"); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="Pasang iklan gratis, pasang iklan properti gratis, jual, beli, sewa, rumah, kostan, ruko, rukan, apartemen, tanah, gudang, pabrik, kios, Sulawesi Selatan, Bantaeng, Barru, Watampone, Bulukumba, Enrekang, Sungguminasa, Jeneponto, Selayar, Belopa, Malili, Masamba, Maros, Pangkep, Pinrang, Sidrap, sinjai, Watansoppeng, Takalar, Makale, Rantepao, Sengkang, Kota Makassar, Kota Parepare, Kota Palopo" />
	<meta name="Title" content="<?= ($page_title != null ? $page_title : "Rumahta.com | Jual, Beli, Sewa, Rumah, Kostan, Tanah, Tempat Usaha di Sulawesi Selatan"); ?>" />
	<meta name="description" content="<?=($page_desc != null ? $page_desc : "Cari rumah, kostan, ruko, rukan, apartemen, tanah, gudang, pabrik, kios, di Sulawesi Selatan. Menjual, Membeli dan menyewa secara online di Rumahta.com"); ?>"/>
	<meta name="copyright" content="&copy; 2012 Binary Project"/>
	<meta name="classification" content="General"/>
	<meta name="rating" content="General"/>
	<meta name="distribution" content="Global"/>
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index,follow" />
	<meta name="msnbot" content="index,follow" />
	<meta name="author" content="www.binary-project.com"/>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>file/img/favicon.ico" type="image/vnd.microsoft.icon" />

	<!-- Attach CSS File -->
	<link rel="stylesheet" href="<?php echo base_url();?>file/css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>file/css/bootstrap.css" />
	
	<!-- Attach JS File -->
	<script src="<?php echo base_url();?>file/js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>file/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>file/js/bootstrap.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(window).load(function(){
		$(document).ready(function() {

			if (screen.width <= 1024) window.location.replace("http://rumahta.com/m");
			
			var windowH = $(window).height();
			var windowW = $(window).width();
			var leftH = $('#left_wrapper').outerHeight(true);
			var rightH = $('#right_wrapper').outerHeight(true);

			var gap = $('#right_wrapper').outerHeight(true) - $('#left_wrapper').outerHeight(true) + 20;
			var gap2 = $('#left_wrapper').outerHeight(true) - $('#right_wrapper').outerHeight(true) - 20;
		   
			var topmenuOffset =  $('#header').outerHeight(true);
			var rightOffset =  $('#right_wrapper').outerHeight(true) - windowH + 160;
			var leftOffset = $('#left_wrapper').outerHeight(true) - windowH + 160;
			var sisaWindow = ($(window).width() - $('#content_wrapper').outerWidth(true)) / 2;
			var padding = 10;
		   
			$(window).scroll(function() {
				var scrollVal = $(this).scrollTop();
				
				/*if(scrollVal > topmenuOffset){
					$('#topmenu_bg').css({'position':'fixed','top': '0px'});
					$('#container').css({'margin':'48px auto'});
				}
				else{
					$('#topmenu_bg').css({'position':'relative','top': '0px'});
				}*/
				
				if(leftH > rightH){

					var leftMargin = $('#left_wrapper').outerWidth(true) + sisaWindow + padding;
					
					if(scrollVal > rightOffset){
						if(scrollVal < leftOffset){
							$('#right_wrapper').css({'position':'fixed','z-index':'10','bottom': '20px','left' : leftMargin + 'px'});
						}
						else{
							$('#right_wrapper').css({'position':'relative','float':'left','margin':gap2 + 'px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
						}
					}
					else{
						$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
					}
				}
				else{
					
					var leftMargin = sisaWindow + padding;
					var leftMarginForSidebar = $('#left_wrapper').outerWidth(true);
					
					if(scrollVal > leftOffset){
						if(scrollVal < rightOffset){
							$('#left_wrapper').css({'position':'fixed','z-index':'10','bottom': '20px','left' : leftMargin + 'px'});
							$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 ' + leftMarginForSidebar + 'px','width':'240px','left':'0px','bottom':'0px'});
						}
						else{
							$('#left_wrapper').css({'position':'relative','left' : '0px','float':'left','margin': gap + 'px 0 0 0'});
							$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
						}
					}
					else{
						$('#left_wrapper').css({'position':'relative','bottom': '0px','left' : '0px','float':'left','margin':'0 0 0 0px'});
						$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'240px','left':'0px','bottom':'0px'});
					}
				}
			});
		 });
		});
	</script>
	
</head>
<body>
	<div id="header">
		<div id="logo"></div>
		<div id="loginform">
			<p>
				Belum punya akun ? <?php echo anchor("home/signup","Daftar Sekarang");?> | <a href="#">Lupa Password</a>
			</p>
			<?php echo form_open("home/validate_login"); ?>
				<img src="<?php echo base_url();?>file/img/icon_username.png" />
				<input type="text" class="span2 login" name="username" id="username" placeholder="username" />
				&nbsp;&nbsp;
				<img src="<?php echo base_url();?>file/img/icon_password.png" />
				<input type="password" class="span2 login" name="password" id="password" placeholder="password" />
				<input type="submit" class="btn btn-inverse" value="&nbsp;&nbsp;Login&nbsp;&nbsp;" />
			<?php echo form_close(); ?>
		</div>
	</div>