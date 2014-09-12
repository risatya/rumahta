		<!--attach file js -->
		<script src="<?php echo base_url();?>file/js/jCarouselLite.js" type="text/javascript"></script>
		
		<script type="text/javascript">
        $(document).ready(function () {
            $('#nav li').hover(
                function () {
                    //show submenu
                    $('ul', this).fadeIn(300);
                },
                function () {
                    //hide submenu
                    $('ul', this).fadeOut(300);
                }
            );
		});
		</script>
		
		<div id="topmenu_wrapper">
			<div id="topmenu_left"></div>
			<div id="topmenu">
				<ul id="nav">
					<li><?php echo anchor("home/index","Depan"); ?></li>
					<div id="linemenu"></div>
					<li>
						<?php echo anchor("page/all_category/1","Jual"); ?>
						<ul>
							<li><?php echo anchor("page/category/1","Rumah Dijual"); ?></li>
							<li><?php echo anchor("page/category/2","Apartemen Dijual"); ?></li>
							<li><?php echo anchor("page/category/3","Tanah Dijual"); ?></li>
							<li><?php echo anchor("page/category/4","Ruko/Rukan Dijual"); ?></li>
							<li><?php echo anchor("page/category/5","Kios Dijual"); ?></li>
							<li><?php echo anchor("page/category/6","Gudang/Pabrik Dijual"); ?></li>
						</ul>
					</li>
					<div id="linemenu"></div>
					<li>
						<?php echo anchor("page/all_category/2","Sewa"); ?>
						<ul>
							<li><?php echo anchor("page/category/9","Rumah Disewakan"); ?></li>
							<li><?php echo anchor("page/category/10","Apartemen Disewakan"); ?></li>
							<li><?php echo anchor("page/category/11","Tanah Disewakan"); ?></li>
							<li><?php echo anchor("page/category/12","Ruko/Rukan Disewakan"); ?></li>
							<li><?php echo anchor("page/category/13","Kios Disewakan"); ?></li>
							<li><?php echo anchor("page/category/14","Gudang/Pabrik Disewakan"); ?></li>
						</ul>
					</li>
					<div id="linemenu"></div>
					<li><?php echo anchor("page/category/15","Indekost"); ?></li>
					<div id="linemenu"></div>
					<li><?php echo anchor("page/category/7","Jasa"); ?></li>
					<div id="linemenu"></div>
					<li><?php echo anchor("page/page_detail/15/pasang-iklan","Pasang Iklan"); ?></li>
					<div id="linemenu"></div>
					<!--<li><?php// echo anchor("page/page_detail/1/info-kpr","Info KPR"); ?></li>-->
					<li><?php echo anchor("page/statistik","Statistik"); ?></li>
					<div id="linemenu"></div>
					<li><?php echo anchor("page/page_detail/2/info-kpr","Info KPR"); ?></li>
					<div id="linemenu"></div>
					<li><?php echo anchor("page/page_detail/3/kontak","Kontak"); ?></li>
				</ul>
			</div>
			<div id="topmenu_right"></div>
		</div>
		<div class="navbar navbar-inverse navbar-fixed-top">
</div>
	<div id="container">