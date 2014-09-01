				<div id="administrator_wrapper">
				
					<div id="admin_sidebar">
						<h1 id="sidebar-title">Administrator</h1>
						
						<?php foreach($admin as $item): ?>
						<div id="profile-links">
							Hello, <a href="#" title="Edit your profile"><?php echo $item->nama; ?></a>, you logged as: <span><?php echo ($item->level == 1 ? "Super Admin" : ($item->level == 2 ? "admin" : "unknown"));  ?></span><br />
							
							<img src="<?php echo base_url(); ?>file/img/admin/<?php echo ($item->admin_photo == null ? "default_pp.jpg" : $item->admin_photo); ?>" width="60px" class="thumbnail" />
							
							<br />
							<?php echo anchor('home/index','View Site',array('title' => 'View the site','target' => '_blank')) ?> | <?php echo anchor('administrator_manager/admin_detail/'.$item->id_admin,'My Profile',array('title' => 'My Profile')); ?> | <?php echo anchor('rumahtadotcom/logout','Log Out',array('title' => 'log out')); ?>
						</div> 
						<?php endforeach; ?>
						
						<div id="admin_menu">
							<?php echo anchor("member_manager/index","Member"); ?>
							<?php echo anchor("listing_manager/index","Listing"); ?>
							<?php //echo anchor("#","Banner"); ?>
							<?php echo anchor("paket_listing_manager/index","Paket Iklan Listing"); ?>
							<?php echo anchor("paket_banner_manager/index","Paket Iklan Banner"); ?>
							<?php echo anchor("testimoni_manager/index","Testimoni"); ?>
							<?php //echo anchor("#","Form Email"); ?>
							<?php echo anchor("administrator_manager/index","Administrator"); ?>
							<?php echo anchor("news_manager/index","Berita"); ?>
							<?php echo anchor("page_manager/index","Halaman"); ?>
						</div>
						
					</div>