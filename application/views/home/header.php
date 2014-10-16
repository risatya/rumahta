<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<title><?= ($page_title != null ? $page_title : "Rumahta.com | rumah dijual di makassar, jual tanah makassar"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="rumah dijual di makassar, jual tanah makassar,Cari rumah, kostan, ruko, rukan, apartemen, tanah, gudang, pabrik, kios, di Makassar, Menjual, Membeli dan menyewa" />
	<meta name="Title" content="<?= ($page_title != null ? $page_title : "Rumahta.com | Jual, Beli, Sewa, Rumah, Kostan, Tanah, Tempat Usaha di Sulawesi Selatan"); ?>" />
	<meta name="description" content="<?=($page_desc != null ? $page_desc : "Cari rumah, kostan, ruko, rukan, apartemen, tanah, gudang, pabrik, kios, di Makassar, Menjual, Membeli dan menyewa lihat infonya di Rumahta.com"); ?>"/>
	<meta name="classification" content="General"/>
	<meta name="rating" content="General"/>
	<meta name="distribution" content="Global"/>
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index,follow" />
	<meta name="msnbot" content="index,follow" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>file/img/favicon.ico" type="image/vnd.microsoft.icon" />

	<!-- Attach CSS File -->
	
    <?php
		if(strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') == true){
			echo "<link rel='stylesheet' href='".base_url()."file/css/style2.css' type='text/css' />";
		}elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') == true){
			echo "<link rel='stylesheet' href='".base_url()."file/css/style.css' type='text/css' />";
		}else{
			echo "<link rel='stylesheet' href='".base_url()."file/css/style.css' type='text/css' />";
		}
	  
	?>
	<link rel="stylesheet" href="<?php echo base_url();?>file/css/bootstrap.css" />

	<!-- Attach JS File -->
	<script src="<?php echo base_url();?>file/js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>file/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>file/js/bootstrap.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>file/js/stickySidebar.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(window).load(function(){
		$(document).ready(function() {
			var windowH = $(window).height();
			var windowW = $(window).width();
			var leftH = $('#left_wrapper').outerHeight(true);
			var rightH = $('#right_wrapper').outerHeight(true);

			var gap = $('#right_wrapper').outerHeight(true) - $('#left_wrapper').outerHeight(true) + 20;
			var gap2 = $('#left_wrapper').outerHeight(true) - $('#right_wrapper').outerHeight(true) - 10;

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
							$('#right_wrapper').css({'position':'fixed','bottom': '20px','left' : leftMargin + 'px'});
						}
						else{
							$('#right_wrapper').css({'position':'relative','float':'left','margin':gap2 + 'px 0 0 0','width':'300px','left':'0px','bottom':'0px'});
						}
					}
					else{
						$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'300px','left':'0px','bottom':'0px'});
					}
				}
				else{

					var leftMargin = sisaWindow + padding;
					var leftMarginForSidebar = $('#left_wrapper').outerWidth(true);

					if(scrollVal > leftOffset){
						if(scrollVal < rightOffset){
							$('#left_wrapper').css({'position':'fixed','bottom': '20px','left' : leftMargin + 'px'});
							$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 ' + leftMarginForSidebar + 'px','width':'300px','left':'0px','bottom':'0px'});
						}
						else{
							$('#left_wrapper').css({'position':'relative','left' : '0px','float':'left','margin': gap + 'px 0 0 0'});
							$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'300px','left':'0px','bottom':'0px'});
						}
					}
					else{
						$('#left_wrapper').css({'position':'relative','bottom': '0px','left' : '0px','float':'left','margin':'0 0 0 0px'});
						$('#right_wrapper').css({'position':'relative','float':'left','margin':'-20px 0 0 0','width':'300px','left':'0px','bottom':'0px'});
					}
				}
			});
		 });
		});
	</script>
</head>
<body>
	<div id="header">
	<div class="row">
		<div id="logo">
		<h2><a href="<?php echo base_url();?>" title="Rumahta.com"><img src="<?php echo base_url();?>file/img/logo.png"></a></h2>
		<h1 style="display:none;">Rumahta.com</h1>
		</div>

		<div id="loginform">
			<p>
				Belum punya akun ? <?php echo anchor("home/signup","Daftar Sekarang");?> | <?php echo anchor("home/forgot","Lupa Password");?>
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
	</div>
