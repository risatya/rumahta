$(window).load(function(){
	$(document).ready(function() {

		var windowH = $(window).height();
		var windowW = $(window).width();
		var leftH = $('#left_wrapper').outerHeight(true);
		var rightH = $('#right_wrapper').outerHeight(true);

		var gap = $('#right_wrapper').outerHeight(true) - $('#left_wrapper').outerHeight(true) + 20;
		var gap2 = $('#left_wrapper').outerHeight(true) - $('#right_wrapper').outerHeight(true) - 20;
	   
		var rightOffset =  $('#right_wrapper').outerHeight(true) - windowH + 160;
		var leftOffset = $('#left_wrapper').outerHeight(true) - windowH + 165;
		var sisaWindow = ($(window).width() - $('#content_wrapper').outerWidth(true)) / 2;
		var padding = 10;
	   
		$(window).scroll(function() {
			var scrollVal = $(this).scrollTop();
			if(leftH > rightH){

				var leftMargin = $('#left_wrapper').outerWidth(true) + sisaWindow + padding;
				var topMarginGap = $('#left_wrapper').outerHeight(true) - $('#right_wrapper').outerHeight(true) - 20;
				
				if(scrollVal > rightOffset){
					if(scrollVal < leftOffset){
						$('#right_wrapper').css({'position':'fixed','bottom': '20px','left' : leftMargin + 'px'});
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
						$('#left_wrapper').css({'position':'fixed','bottom': '20px','left' : leftMargin + 'px'});
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
		
		
		$('a[rel*=facebox]').facebox(
			{
			loadingImage : 'http://localhost/rumahta/file/img/facebox/loading.gif',
			closeImage   : 'http://localhost/rumahta/file/img/facebox/closelabel.png'
			}
		);
		
		
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
		$('.kriteria').click(function() {
			$('#kriteria_tambahan').toggle();
		});
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
		
		
		var cat = $("#kategori").val();
							
		if(cat == 1 || cat == 2 || cat == 4 || cat == 9 || cat == 10 || cat == 12){
			$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
			$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
		}
		else if(cat == 3 || cat == 11){
			$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#ltanah,#arah,#fasilitas_lokasi").show();
			$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#fasilitas_kios,#dlistrik,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
		}
		else if(cat == 5 || cat == 13){
			$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#dlistrik,#fasilitas_lokasi,#fasilitas_kios").show();
			$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#ltanah,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
		}
		else if(cat == 6 || cat == 14){
			$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#jlantai,#ltanah").show();
			$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost,#fasilitas_lokasi,#fasilitas_kios").hide();
		}
		else if(cat == 15){
			$("#judul,#kabupaten,#harga,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#keterangan,#listing_photo,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").show();
			$("#kondisi,#sertifikat,#mls,#status,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios").hide();
		}
		else if(cat == 7){
			$("#judul,#status,#keterangan,#listing_photo,").show();
			$("#kondisi,#sertifikat,#mls,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios,#kabupaten,#harga,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").hide();
		}
		else{
			$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
			$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
		}
		
		
		$("#kategori").change(function(){
			
			var cat = this.value;
			if(cat == 1 || cat == 2 || cat == 4 || cat == 9 || cat == 10 || cat == 12){
				$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
				$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
			}
			else if(cat == 3 || cat == 11){
				$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#ltanah,#arah,#fasilitas_lokasi").show();
				$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#fasilitas_kios,#dlistrik,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
			}
			else if(cat == 5 || cat == 13){
				$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#dlistrik,#fasilitas_lokasi,#fasilitas_kios").show();
				$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#ltanah,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost").hide();
			}
			else if(cat == 6 || cat == 14){
				$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#lbangunan,#jlantai,#ltanah").show();
				$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#fasilitas_kamar,#fasilitas_kost,#fasilitas_lokasi,#fasilitas_kios").hide();
			}
			else if(cat == 15){
				$("#judul,#kabupaten,#harga,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#keterangan,#listing_photo,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").show();
				$("#kondisi,#sertifikat,#mls,#status,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios").hide();
			}
			else if(cat == 7){
				$("#kabupaten,#judul,#status,#keterangan,#listing_photo,").show();
				$("#kondisi,#harga,#sertifikat,#mls,#dlistrik,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#arah,#furniture,#lbangunan,#jlantai,#ltanah,#fasilitas_kios,#with_owner,#dekat_dgn,#penghuni,#penghuni_mayoritas,#kodepos,#fasilitas_lokasi,#fasilitas_kamar,#fasilitas_kost,").hide();
			}
			else{
				$("#judul,#kabupaten,#kondisi,#harga,#kodepos,#sertifikat,#mls,#keterangan,#listing_photo,#jlantai,#ktidur,#kmandi,#garage,#sumberair,#pembantu,#lbangunan,#arah,#dlistrik,#furniture,#ltanah,#fasilitas_lokasi").show();
				$("#status,#penghuni,#penghuni_mayoritas,#with_owner,#dekat_dgn,#fasilitas_kios,#fasilitas_kamar,#fasilitas_kost").hide();
			}
			
		});
		
		$("#show_map").change(function(){
			var x = this.value;
			if(x == 0){
				$("#map_wrapper").hide();
			}
			else{
				$("#map_wrapper").show();
			}
		});
		
	});
});