		<div class="navbar" id="member_navi">
		  <div class="navbar-inner">
			<div class="container">
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Profil<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><?php echo anchor("member/index","Lihat Profil");?></li>
						  <li><?php echo anchor("member/edit_profile","Edit Profil");?></li>
						  <li><?php echo anchor("member/url_member","URL Member");?></li>
						</ul>
					 </li>
					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-tag"></i> Listing<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><?php echo anchor("member_listing/index","Pengaturan Listing")?></li>
						  <li><?php echo anchor("member_listing/pilih_paket","Pasang Iklan")?></li>
						  <li class="divider"></li>
						  <li class="nav-header">Paket Iklan Listing</li>
						  <li><?php echo anchor("page/page_detail/17/peraturan-dan-ketentuan","Peraturan dan Ketentuan"); ?></li>
						  <li><?php echo anchor("paket_listing/index","Daftar / Upgrade Paket"); ?></li>
						  <li><?php echo anchor("paket_listing/confirm","Konfirmasi Pembayaran"); ?></li>
						</ul>
					 </li>
					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-bookmark"></i> Banner<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><?php echo anchor("member_banner/index","Pesan Banner"); ?></li>
						  <li><?php echo anchor("member_banner/confirm","Konfirmasi Pembayaran"); ?></li>
						  <li class="divider"></li>
						  <li class="nav-header">Paket Iklan Banner</li>
						  <li><?php echo anchor("page/page_detail/18/peraturan-dan-ketentuan","Peraturan dan Ketentuan"); ?></li>
						</ul>
					 </li>
					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-comment"></i> Testimonial<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><?php  echo anchor("testimoni/index","Buat Testimoni") ?></li>
						  <li><?php  echo anchor("testimoni/testimoni_list","Pengaturan") ?></li>
						</ul>
					 </li>
					 <li>

						<?php echo anchor("page/page_detail/16/bantuan","<i class='icon-wrench'></i>Bantuan"); ?>
					 </li>
					 <li>
						<?php echo anchor("page/search_page","<i class='icon-search'></i> Pencarian"); ?>
					 </li>
				</ul>
			</div>
		  </div>
		</div>
