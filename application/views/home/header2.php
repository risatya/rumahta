<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<title><?= ($page_title != null ? $page_title : "Rumahta.com | Jual, Beli, Sewa, Rumah, Kostan, Tanah, Tempat Usaha di Sulawesi Selatan"); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="Pasang iklan gratis, pasang iklan properti gratis, jual, beli, sewa, rumah, kostan, ruko, rukan, apartemen, tanah, gudang, pabrik, kios, Sulawesi Selatan, Bantaeng, Barru, Watampone, Bulukumba, Enrekang, Sungguminasa, Jeneponto, Selayar, Belopa, Malili, Masamba, Maros, Pangkep, Pinrang, Sidrap, sinjai, Watansoppeng, Takalar, Makale, Rantepao, Sengkang, Kota Makassar, Kota Parepare, Kota Palopo" />
	<meta name="Title" content="<?= ($page_title != null ? $page_title : "Rumahta.com | Jual, Beli, Sewa, Rumah, Kostan, Tanah, Tempat Usaha di Sulawesi Selatan"); ?>" />
	<meta name="description" content="<?=($page_desc != null ? $page_desc : "Cari rumah, kostan, ruko, rukan, apartemen, tanah, gudang, pabrik, kios, di Sulawesi Selatan. Menjual, Membeli dan menyewa secara online di Rumahta.com"); ?>"/>
	<meta name="classification" content="General"/>
	<meta name="rating" content="General"/>
	<meta name="distribution" content="Global"/>
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index,follow" />
	<meta name="msnbot" content="index,follow" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>file/img/favicon.ico" type="image/vnd.microsoft.icon" />

	<!-- Attach CSS File -->
	<link rel="stylesheet" href="<?php echo base_url();?>file/css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>file/css/bootstrap.css" />
	
	<!-- Attach JS File -->
	<script src="<?php echo base_url();?>file/js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>file/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>file/js/bootstrap.js" type="text/javascript"></script>
	
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
	</div>