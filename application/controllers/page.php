<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_listing');
		$this->load->model('mdl_page');
		$this->load->model('mdl_member');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function listing_detail($id,$url_title=''){
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$data['list_listing'] = $this->mdl_listing->getFreeListingForPageRandom(10,0);
			
			
			$cek = $this->mdl_page->cekListingDetail($id);
			if($cek){
				$data['listing'] = $this->mdl_page->getListingDetail($id);
				$data['data_user'] = $this->mdl_page->getMemberDetail($data['listing'][0]->id_user);
				//ambil foto listing.
				$data['listing_photo'] = $this->mdl_listing->getListingPhotoByID($data['listing'][0]->id_listing_member);
				$data['listing_cover'] = $this->mdl_listing->getListingCoverByID($id);
				
						
				$data['page_title'] = $data['listing'][0]->nama_kategori." - ".$data['listing'][0]->judul." | Rumahta.com";
				$data['page_desc'] = $data['listing'][0]->nama_kabupaten.", ".$data['listing'][0]->alamat.", ".$data['listing'][0]->keterangan;
				
				//tambahin view di database...
				$insertData = array(
					"id_listing_member" => $id,
					"id_user" => $data['listing'][0]->id_user,
					"tanggal" => date("Y-m-d H:i:s")
				);
				$this->mdl_page->addListingView($insertData);
				
				$data['page_title'] = $data['listing'][0]->nama_kategori." - ".$data['listing'][0]->judul;
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header2",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member2",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_menu");
				}
				
				$cate = $data['listing'][0]->id_kategori;
				
				if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("page/listing_detail1",$data);
				}
				else if($cate == 3 || $cate == 11){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("page/listing_detail2",$data);
				}
				else if($cate == 5 || $cate == 13){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kios'] = $this->mdl_listing->getFasilitasKiosByID($id);
					$this->load->view("page/listing_detail3",$data);
				}
				else if($cate == 6 || $cate == 14){
					$this->load->view("page/listing_detail4",$data);
				}
				else if($cate == 7){
					$this->load->view("page/listing_detail5",$data);
				}
				else if($cate == 15){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kamar'] = $this->mdl_listing->getFasilitasKamarByID($id);
					$data['fasilitas_kost'] = $this->mdl_listing->getFasilitasKostByID($id);
					$this->load->view("page/listing_detail6",$data);
				}
				else{
				}
				
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
			else{
				redirect('home/index');
			}
		
	}
	
	public function all(){
		
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['premium'] = $this->mdl_home->getPremiumListingCount();
			$data['free'] = $this->mdl_home->getFreeListingCount();

			$total_row = $this->db->count_all('tbl_listing_member');
			//$per_pageData = ($data['premium'] % 2 == 0 ? 10 : 11);
			// $per_page = (($data['premium'] % $per_pageData) % 2 == 0 ? )
			
			$per_page = 9;
			do{
				$per_page++;
				$per_pageData = $data['premium'] % $per_page;
				$sisaFree = $per_page - $per_pageData ;
			}
			while(($sisaFree % 2 == 0) && ($per_page % 2 == 0));
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/all_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= $per_page;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['premium_listing'] = $this->mdl_listing->getPremiumListingForPage($config['per_page'],0);
			$data['free_listing'] = $this->mdl_listing->getFreeListingForPage($config['per_page'],0);
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_premium'] = array();
			foreach($data['premium_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_premium'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			//ambil cover foto masing - masing listing gratis..
			$x = 0;
			$data['cover_free'] = array();
			foreach($data['free_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_free'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			// print_r($data['premium_listing']);
			// print_r("<br/><br/>");
			// print_r($data['free_listing']);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_listing",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
	}
	
	public function all_nextpage(){

			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['premium'] = $this->mdl_home->getPremiumListingCount();
			$data['free'] = $this->mdl_home->getFreeListingCount();

			$total_row = $this->db->count_all('tbl_listing_member');
			
			$per_page = 10;
			if($data['premium'] > $per_page){
				$sisaPremium = $data['premium'] % $per_page; //jumlah listing premium di halamn terahir ?
				$premiumLastPage = floor($data['premium'] / $per_page);
			}
			else{
				$sisaPremium = $data['premium'];
				$premiumLastPage = 0;
			}
			$sisaFree = $per_page - $sisaPremium;
			$a = $sisaFree % 2;
			$sessionData = array();
			if($a == 1){
				$start_page = $premiumLastPage * $per_page;
			}
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/all_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 15;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			// $data['premium_listing'] = $this->mdl_listing->getPremiumListingForPage($config['per_page'],$this->uri->segment(3));
			// $data['free_listing'] = $this->mdl_listing->getFreeListingForPage($config['per_page'],$this->uri->segment(3));
			if($this->uri->segment(3) == $start_page){
				$data['list_listing'] = $this->mdl_listing->getListingForPage(15,$this->uri->segment(3));
			}
			else{
				$data['list_listing'] = $this->mdl_listing->getListingForPage($config['per_page'],$this->uri->segment(3));
			}
			
			//ambil cover foto masing - masing listing premium.
			// $x = 0;
			// $data['cover_premium'] = array();
			// foreach($data['premium_listing'] as $item):
				// $cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				// $data['cover_premium'][$x] = $cover[0]->listing_photo_list;
				// $x++;
			// endforeach;
			
			//ambil cover foto masing - masing listing gratis..
			// $x = 0;
			// $data['cover_free'] = array();
			// foreach($data['free_listing'] as $item):
				// $cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				// $data['cover_free'][$x] = $cover[0]->listing_photo_list;
				// $x++;
			// endforeach;
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_listing'] = array();
			foreach($data['list_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			// print_r($data['premium_listing']);
			// print_r("<br/><br/>");
			// print_r($data['free_listing']);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_listing",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");

	}
	
	public function all_category($cat){
			$cek = $this->mdl_page->cekStatusCategory($cat);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
				// $data['premium'] = $this->mdl_home->getPremiumListingCount();
				$total_row = $this->mdl_page->getCountByStatusCategory($cat);
				
				$per_page = 10;
				if($data['premium'] > $per_page){
					$sisaPremium = $data['premium'] % $per_page; //jumlah listing premium di halamn terahir ?
					$premiumLastPage = floor($data['premium'] / $per_page);
				}
				else{
					$sisaPremium = $data['premium'];
					$premiumLastPage = 0;
				}
				$sisaFree = $per_page - $sisaPremium;
				$a = $sisaFree % 2;
				$sessionData = array();
				if($a == 1){
					$start_page = $premiumLastPage * $per_page;
				}
			
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/page/all_category_nextpage/'.$cat.'/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 10;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo; ';
				$config['prev_link'] 	= ' &laquo; Prev';
				$config['uri_segment'] 	= 4;
				$this->pagination->initialize($config);
				if($start_page === 0){
					$data['list_listing'] = $this->mdl_listing->getListingByStatusCategory($cat, 11, 0);
				}
				else{
					$data['list_listing'] = $this->mdl_listing->getListingByStatusCategory($cat, $config['per_page'], 0);
				}
				$x = 0;
				$data['cover_listing'] = array();
				foreach($data['list_listing'] as $item):
					$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
					$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
					$x++;
				endforeach;
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header");
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/all_listing",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
			else{
				redirect("home/index");
			}
	}
	
	public function all_category_nextpage($cat){
			$cek = $this->mdl_page->cekStatusCategory($cat);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
				// $data['premium'] = $this->mdl_home->getPremiumListingCount();
				$total_row = $this->mdl_page->getCountByStatusCategory($cat);
				
				$per_page = 10;
				if($data['premium'] > $per_page){
					$sisaPremium = $data['premium'] % $per_page; //jumlah listing premium di halamn terahir ?
					$premiumLastPage = floor($data['premium'] / $per_page);
				}
				else{
					$sisaPremium = $data['premium'];
					$premiumLastPage = 0;
				}
				$sisaFree = $per_page - $sisaPremium;
				$a = $sisaFree % 2;
				$sessionData = array();
				if($a == 1){
					$start_page = $premiumLastPage * $per_page;
				}
				
				// print_r($total_row);
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/page/all_category_nextpage/'.$cat.'/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 10;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo; ';
				$config['prev_link'] 	= ' &laquo; Prev';
				$config['uri_segment'] 	= 4;
				$this->pagination->initialize($config);
				
				if($this->uri->segment(4) == $start_page){
					$data['list_listing'] = $this->mdl_listing->getListingByStatusCategory($cat, 11, (int)$this->uri->segment(4));
				}
				else{
					$data['list_listing'] = $this->mdl_listing->getListingByStatusCategory($cat, $config['per_page'], (int)$this->uri->segment(4));
				}
				
				$x = 0;
				$data['cover_listing'] = array();
				foreach($data['list_listing'] as $item):
					$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
					$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
					$x++;
				endforeach;
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header");
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/all_listing",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
					
			}
			else{
				redirect("home/index");
			}
	}
	
	public function category($id_category){
			$cek = $this->mdl_page->cekIDCategory($id_category);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
				//ambil detail category
				$category_detail = $this->mdl_home->getCategoryByIDCategory($id_category);
				$data['page_title'] = $category_detail[0]->nama_kategori." | Rumahta.com";
				
				// $data['premium'] = $this->mdl_home->getPremiumListingCount();
				$total_row = $this->mdl_page->getCountByCategory($id_category);
				
				$per_page = 10;
				if($data['premium'] > $per_page){
					$sisaPremium = $data['premium'] % $per_page; //jumlah listing premium di halamn terahir ?
					$premiumLastPage = floor($data['premium'] / $per_page);
				}
				else{
					$sisaPremium = $data['premium'];
					$premiumLastPage = 0;
				}
				$sisaFree = $per_page - $sisaPremium;
				$a = $sisaFree % 2;
				$sessionData = array();
				if($a == 1){
					$start_page = $premiumLastPage * $per_page;
				}
			
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/page/category_nextpage/'.$id_category.'/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 10;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo; ';
				$config['prev_link'] 	= ' &laquo; Prev';
				$config['uri_segment'] 	= 4;
				$this->pagination->initialize($config);
				
				if(start_page == 0){
					$data['list_listing'] = $this->mdl_listing->getListingByCategory($id_category,11, 0);
				}
				else{
					$data['list_listing'] = $this->mdl_listing->getListingByCategory($id_category, $config['per_page'], 0);
				}
		
				
				$x = 0;
				$data['cover_listing'] = array();
				foreach($data['list_listing'] as $item):
					$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
					$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
					$x++;
				endforeach;
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/all_listing");
				$this->load->view("home/sidebar");
				$this->load->view("home/news");
				$this->load->view("home/footer");
			}
			else{
				redirect("home/index");
			}
	}
	
	public function category_nextpage($id_category){

			$cek = $this->mdl_page->cekIDCategory($id_category);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
				//ambil detail category
				$category_detail = $this->mdl_home->getCategoryByIDCategory($id_category);
				$data['page_title'] = $category_detail[0]->nama_kategori." | Rumahta.com";
				
				// $data['premium'] = $this->mdl_home->getPremiumListingCount();
				$total_row = $this->mdl_page->getCountByCategory($id_category);
				
				$per_page = 10;
				if($data['premium'] > $per_page){
					$sisaPremium = $data['premium'] % $per_page; //jumlah listing premium di halamn terahir ?
					$premiumLastPage = floor($data['premium'] / $per_page);
				}
				else{
					$sisaPremium = $data['premium'];
					$premiumLastPage = 0;
				}
				$sisaFree = $per_page - $sisaPremium;
				$a = $sisaFree % 2;
				$sessionData = array();
				if($a == 1){
					$start_page = $premiumLastPage * $per_page;
				}
			
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/page/category_nextpage/'.$id_category.'/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 10;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo; ';
				$config['prev_link'] 	= ' &laquo; Prev';
				$config['uri_segment'] 	= 4;
				$this->pagination->initialize($config);
				
				if($this->uri->segment(4) == $start_page){
					$data['list_listing'] = $this->mdl_listing->getListingByCategory($id_category, 11, (int)$this->uri->segment(4));
				}
				else{
					$data['list_listing'] = $this->mdl_listing->getListingByCategory($id_category, $config['per_page'], (int)$this->uri->segment(4));
				}
				
				$x = 0;
				$data['cover_listing'] = array();
				foreach($data['list_listing'] as $item):
					$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
					$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
					$x++;
				endforeach;
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/all_listing");
				$this->load->view("home/sidebar");
				$this->load->view("home/news");
				$this->load->view("home/footer");
			}
			else{
				redirect("home/index");
			}
		
	}
	
	public function news_detail($id_news,$title_link=''){
	
			$cek = $this->mdl_page->cekNews($id_news);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				$data['news_detail'] = $this->mdl_page->getNewsByID($id_news);
				
				$data['page_title'] = $data['news_detail'][0]->title." | Rumahta.com";
				// $s = substr(strip_tags(html_entity_decode($data['page_content'][0]->content)), 0, 300);
				// $desc = substr($s, 0, strrpos($s, ' '));
				// $data['page_desc'] = $desc;
				
				// print_r($data['news_detail']);
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner");
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/news_detail");
				$this->load->view("home/sidebar");
				$this->load->view("home/news");
				$this->load->view("home/footer");
			}
			else{
				redirect("home/index");
			}
		
	}
	
	public function all_news(){

			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['page_title'] = "Berita | Rumahta.com";
			
			// setting pagination...
			$total_row = $this->mdl_page->getCountAllNews();
		
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/news_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_news'] = $this->mdl_page->getAllNews($config['per_page'], 0);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_news",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		
	}
	
	public function news_nextpage(){

			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['page_title'] = "Berita | Rumahta.com";
			
			// setting pagination...
			$total_row = $this->mdl_page->getCountAllNews();
		
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/news_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_news'] = $this->mdl_page->getAllNews($config['per_page'], $this->uri->segment(3));
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_news",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		
	}
	
	public function testimoni_detail($id_testi){

			$cek = $this->mdl_page->cekTestimoni($id_testi);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				$data['testi_detail'] = $this->mdl_page->getTestimoniByID($id_testi);
				
				// print_r($data['news_detail']);
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header");
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/testimoni_detail",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
			else{
				redirect("home/index");
			}
		
	}
	
	public function all_testimoni(){

			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['page_title'] = "Testimoni | Rumahta.com";
			
			// setting pagination...
			$total_row = $this->mdl_page->getCountAllTesti();
		
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/testimoni_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_testi'] = $this->mdl_page->getAllTesti($config['per_page'], 0);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_testimoni",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		
	}
	
	public function testimoni_nextpage(){

			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['page_title'] = "Testimoni | Rumahta.com";
			
			// setting pagination...
			$total_row = $this->mdl_page->getCountAllTesti();
		
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/testimoni_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_testi'] = $this->mdl_page->getAllTesti($config['per_page'], $this->uri->segment(3));
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_testimoni",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		
	}
	
	public function page_detail($id_page,$title){

			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$data['page_content'] = $this->mdl_page->getPageDetail($id_page);
			
			$data['page_title'] = $data['page_content'][0]->title." | Rumahta.com";
			$s = substr(strip_tags(html_entity_decode($data['page_content'][0]->content)), 0, 300);
			$desc = substr($s, 0, strrpos($s, ' '));
			$data['page_desc'] = $desc;
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner");
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/page_detail");
			$this->load->view("home/sidebar");
			$this->load->view("home/news");
			$this->load->view("home/footer");
		
	}
	
	public function statistik(){
	
		
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['page_title'] = "Statistik | Rumahta.com";
			
			//ambil data statistik jumlah listing yang terpasang per bulan..
			$this->load->model('mdl_statistik');
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 11; $x>=0; $x--){
				$listing_terpasang = array();
				$getDate = mktime(0,0,0, date("m")-$x ,date("d") , date("Y"));
				$listing_terpasang = $this->mdl_statistik->getListingCount(1,date("m",$getDate),date("Y",$getDate));
				$data['statistik'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik'][$count]['listing'] = ($listing_terpasang[0]->counter == null ? 0 : $listing_terpasang[0]->counter);
				$count++;
			}
			
			//ambil data statistik jumlah listing yang laku per bulan..
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 11; $x>=0; $x--){
				$listing_terpasang = array();
				$getDate = mktime(0,0,0, date("m")-$x ,date("d") , date("Y"));
				$listing_terpasang = $this->mdl_statistik->getListingCount(2,date("m",$getDate),date("Y",$getDate));
				$data['statistik2'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik2'][$count]['listing'] = ($listing_terpasang[0]->counter == null ? 0 : $listing_terpasang[0]->counter);
				$count++;
			}
			
			//ambil data jumlah pengunjung per hari.
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 11; $x>=0; $x--){
				$listing_terpasang = array();
				$getDate = mktime(0,0,0, date("m") ,date("d")-$x , date("Y"));
				$visitor = $this->mdl_statistik->getVisitorCount(date("Y-m-d H:i:s",$getDate));
				$data['statistik3'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik3'][$count]['visitor'] = ($visitor[0]->counter == null ? 0 : $visitor[0]->counter);
				$count++;
			}
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner");
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner");
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/statistik");
			$this->load->view("home/sidebar");
			$this->load->view("home/news");
			$this->load->view("home/footer");
		
	}
	
	public function search(){

		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('keyword','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('location','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('category','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('status','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('kamar_tidur_min','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('kamar_tidur_max','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('kamar_mandi_min','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('kamar_mandi_max','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('lbangunan_min','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('lbangunan_max','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('ltanah_min','','trim|xss_clean|htmlentities|strip_tags');
			$this->form_validation->set_rules('ltanah_max','','trim|xss_clean|htmlentities|strip_tags');
			
			if($this->form_validation->run() == true){
				
				$category = array();
				
				$status = $this->input->post('status');
				$cat = $this->input->post('category');
				$keyword = $this->input->post('keyword');
				$location = $this->input->post('location');
				$kamar_tidur_min = $this->input->post('kamar_tidur_min');
				$kamar_tidur_max = $this->input->post('kamar_tidur_max');
				$kamar_mandi_min = $this->input->post('kamar_mandi_min');
				$kamar_mandi_max = $this->input->post('kamar_mandi_max');
				$lbangunan_min = $this->input->post('lbangunan_min');
				$lbangunan_max = $this->input->post('lbangunan_max');
				$ltanah_min = $this->input->post('ltanah_min');
				$ltanah_max = $this->input->post('ltanah_max');
				
				if($status != null){
					if($status == 1){
						switch($cat){
							case 1:
								$category = array(1);
								break;
							case 2:
								$category = array(2);
								break;
							case 3:
								$category = array(3);
								break;
							case 4:
								$category = array(4);
								break;
							case 5:
								$category = array(5);
								break;
							case 6:
								$category = array(6);
								break;
							case 7:
								$category = array(7);
								break;
							case 8:
								$category = array(15);
								break;
							default:
								$category = array(1,2,3,4,5,6,7);
						}	
					}
					else if($status == 2){
						switch($cat){
							case 1:
								$category = array(9);
								break;
							case 2:
								$category = array(10);
								break;
							case 3:
								$category = array(11);
								break;
							case 4:
								$category = array(12);
								break;
							case 5:
								$category = array(13);
								break;
							case 6:
								$category = array(14);
								break;
							case 7:
								$category = array(7);
								break;
							case 8:
								$category = array(15);
								break;
							default:
								$category = array(8,9,10,11,12,13,14,15);
						}
					}
					else{
						switch($cat){
							case 1:
								$category = array(1,9);
								break;
							case 2:
								$category = array(2,10);
								break;
							case 3:
								$category = array(3,11);
								break;
							case 4:
								$category = array(4,12);
								break;
							case 5:
								$category = array(5,13);
								break;
							case 6:
								$category = array(6,14);
								break;
							case 7:
								$category = array(7);
								break;
							case 8:
								$category = array(15);
								break;
							default:
								$category = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
						}
					}
				}
				else{
					switch($cat){
						case 1:
							$category = array(1,9);
							break;
						case 2:
							$category = array(2,10);
							break;
						case 3:
							$category = array(3,11);
							break;
						case 4:
							$category = array(4,12);
							break;
						case 5:
							$category = array(5,13);
							break;
						case 6:
							$category = array(6,14);
							break;
						case 7:
							$category = array(7);
							break;
						case 8:
							$category = array(15);
							break;
						default:
							$category = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
					}
				}
				
				//reset session search sebelumnya..
				$searchData = array(
					"keyword" => null,
					"location" => null,
					"kamar_tidur_min" => null,
					"kamar_tidur_max" => null,
					"kamar_mandi_min" => null,
					"kamar_mandi_max" => null,
					"lbangunan_min" => null,
					"lbangunan_max" => null,
					"ltanah_min" => null,
					"ltanah_max" => null,
					"category" => array()
				);
				$this->session->unset_userdata($searchData);
				
				//insert session search yang baru...
				$searchData = array(
					"keyword" => $keyword,
					"location" => $location,
					"kamar_tidur_min" => $kamar_tidur_min,
					"kamar_tidur_max" => $kamar_tidur_max,
					"kamar_mandi_min" => $kamar_mandi_min,
					"kamar_mandi_max" => $kamar_mandi_max,
					"lbangunan_min" => $lbangunan_min,
					"lbangunan_max" => $lbangunan_max,
					"ltanah_min" => $ltanah_min,
					"ltanah_max" => $ltanah_max,
					"category" => $category
				);
				$this->session->set_userdata($searchData);
				
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
				$total_row = $this->mdl_listing->countSearchListing($searchData);
			
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/page/search_nextpage/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 10;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo;';
				$config['prev_link'] 	= ' &laquo; Prev';
				$this->pagination->initialize($config);

				$data['list_listing'] = $this->mdl_listing->searchListing($searchData,$config['per_page'],0);
				// print_r($data['list_listing']);
				
				//ambil cover foto masing - masing listing premium.
				$x = 0;
				$data['cover_listing'] = array();
				foreach($data['list_listing'] as $item):
					$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
					$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
					$x++;
				endforeach;
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header");
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("home/search");
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$data['info_paket'] = $this->mdl_listing->getPaketInfo();
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_menu");
				}
				$this->load->view("page/all_listing",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
				
			}
			else{
				redirect('home/index');
			}
		
	}
	
	public function search_nextpage(){
		
			$category = array();
			
			$keyword = $this->session->userdata('keyword');
			$location = $this->session->userdata('location');
			$kamar_tidur_min = $this->session->userdata('kamar_tidur_min');
			$kamar_tidur_max = $this->session->userdata('kamar_tidur_max');
			$kamar_mandi_min = $this->session->userdata('kamar_mandi_min');
			$kamar_mandi_max = $this->session->userdata('kamar_mandi_max');
			$lbangunan_min = $this->session->userdata('lbangunan_min');
			$lbangunan_max = $this->session->userdata('lbangunan_max');
			$ltanah_min = $this->session->userdata('ltanah_min');
			$ltanah_max = $this->session->userdata('ltanah_max');
			
			$searchData = array(
				"keyword" => $keyword,
				"location" => $location,
				"kamar_tidur_min" => $kamar_tidur_min,
				"kamar_tidur_max" => $kamar_tidur_max,
				"kamar_mandi_min" => $kamar_mandi_min,
				"kamar_mandi_max" => $kamar_mandi_max,
				"lbangunan_min" => $lbangunan_min,
				"lbangunan_max" => $lbangunan_max,
				"ltanah_min" => $ltanah_min,
				"ltanah_max" => $ltanah_max,
				"category" => $this->session->userdata('category')
			);
			
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$total_row = $this->mdl_listing->countSearchListing($searhData);
		
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/search_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo;';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);

			$data['list_listing'] = $this->mdl_listing->searchListing($searhData,$config['per_page'],$this->uri->segment(3));
			// print_r($data['list_listing']);
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_listing'] = array();
			foreach($data['list_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("home/search");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
			}
			$this->load->view("page/all_listing",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		
	}
	
	public function search_page(){
		
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			// print_r($data['news_detail']);
			
			if($this->session->userdata("logged_in") == false){
				redirect("home/index");
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['info_paket'] = $this->mdl_listing->getPaketInfo();
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_menu");
				$this->load->view("page/search",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
		
	}
	
}