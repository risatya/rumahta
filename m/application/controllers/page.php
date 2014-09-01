<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_listing');
		$this->load->model('mdl_page');
		$this->load->model('mdl_member');
    }
	
	public function index(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("page/all_category");
				$this->load->view("home/footer");
			}
			else{
				$this->load->view("home/header",$data);
				$this->load->view("page/all_category");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function all_nextpage(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$total_row = $this->db->count_all('tbl_listing_member');
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/all_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			
			$data['list_listing'] = $this->mdl_listing->getListingForPage($config['per_page'],$this->uri->segment(3));
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_listing'] = array();
			foreach($data['list_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/all_listing");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_listing");
				$this->load->view("home/footer");	
			}
		}
	}
	
	public function listing_detail($id){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$cek = $this->mdl_page->cekListingDetail($id);
			if($cek){
				$data['listing'] = $this->mdl_page->getListingDetail($id);
				$data['data_user'] = $this->mdl_page->getMemberDetail($data['listing'][0]->id_user);
				//ambil foto listing.
				$data['listing_photo'] = $this->mdl_listing->getListingPhotoByID($data['listing'][0]->id_listing_member);
				$data['listing_cover'] = $this->mdl_listing->getListingCoverByID($id);
				
				//tambahin view di database...
				$insertData = array(
					"id_listing_member" => $id,
					"id_user" => $data['listing'][0]->id_user,
					"tanggal" => date("Y-m-d H:i:s")
				);
				$this->mdl_page->addListingView($insertData);
				
				$cate = $data['listing'][0]->id_kategori;
				
				if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$view_listing = "page/listing_detail1";
				}
				else if($cate == 3 || $cate == 11){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$view_listing = "page/listing_detail2";
				}
				else if($cate == 5 || $cate == 13){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kios'] = $this->mdl_listing->getFasilitasKiosByID($id);
					$view_listing = "page/listing_detail3";
				}
				else if($cate == 6 || $cate == 14){
					$view_listing = "page/listing_detail4";
				}
				else if($cate == 7){
					$view_listing = "page/listing_detail5";
				}
				else if($cate == 15){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kamar'] = $this->mdl_listing->getFasilitasKamarByID($id);
					$data['fasilitas_kost'] = $this->mdl_listing->getFasilitasKostByID($id);
					$view_listing = "page/listing_detail6";
				}
				else{
					redirect('home/index');
				}
				
				if($this->session->userdata("logged_in") == false){
					$this->load->view("home/header",$data);
					$this->load->view($view_listing);
					$this->load->view("home/footer");	
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$this->load->view("home/header",$data);
					$this->load->view($view_listing);
					$this->load->view("home/footer");
				}
			}
			else{
				redirect('home/index');
			}
		}
	}
	public function all_kategori(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header");
				$this->load->view("page/all_category");
				$this->load->view("home/footer");
			}
			else{
				$this->load->view("home/header",$data);
				$this->load->view("page/all_category");
				$this->load->view("home/footer");
			}
		}
	}
	public function category($id_category){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$total_row = $this->mdl_page->getCountByCategory($id_category);
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/category_nextpage/'.$id_category.'/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo;';
			$config['prev_link'] 	= ' &laquo; Prev';
			$config['uri_segment'] 	= 4;
			$this->pagination->initialize($config);

			$data['list_listing'] = $this->mdl_listing->getListingByCategory($id_category, $config['per_page'], 0);
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_listing'] = array();
			foreach($data['list_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/all_listing");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_listing");
				$this->load->view("home/footer");
			}
		}
	}
	public function category_nextpage($id_category){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$total_row = $this->mdl_page->getCountByCategory($id_category);
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/category_nextpage/'.$id_category.'/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo;';
			$config['prev_link'] 	= ' &laquo; Prev';
			$config['uri_segment'] 	= 4;
			$this->pagination->initialize($config);

			$data['list_listing'] = $this->mdl_listing->getListingByCategory($id_category, $config['per_page'], $this->uri->segment(4));
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_listing'] = array();
			foreach($data['list_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/all_listing");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_listing");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function all_news(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
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
				$this->load->view("home/header",$data);
				$this->load->view("page/all_news");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_news");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function news_nextpage(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
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
				$this->load->view("home/header",$data);
				$this->load->view("page/all_news");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_news");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function news_detail($id_news){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$data['news_detail'] = $this->mdl_page->getNewsByID($id_news);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/news_detail");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/news_detail");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function all_testi(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$total_row = $this->mdl_page->getCountAllTesti();
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/testi_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_testi'] = $this->mdl_page->getAllTesti($config['per_page'], 0);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/all_testi");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_testi");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function testi_nextpage(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$total_row = $this->mdl_page->getCountAllTesti();
			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/testi_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_testi'] = $this->mdl_page->getAllTesti($config['per_page'], $this->uri->segment(3));
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/all_testi");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/all_testi");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function testi_detail($id_testi){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$data['testi_detail'] = $this->mdl_page->getTestimoniByID($id_testi);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/testi_detail");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/testi_detail");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function page_detail($id_page){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$data['page_content'] = $this->mdl_page->getPageDetail($id_page);
			
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/page_detail");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/page_detail");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function search_page(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			if($this->session->userdata("logged_in") == false){
				$this->load->view("home/header",$data);
				$this->load->view("page/search");
				$this->load->view("home/footer");	
			}
			else{
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$this->load->view("home/header",$data);
				$this->load->view("page/search");
				$this->load->view("home/footer");
			}
		}
	}
	
	public function search(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
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
					$this->load->view("home/header",$data);
					$this->load->view("page/search_listing");
					$this->load->view("home/footer");	
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$this->load->view("home/header",$data);
					$this->load->view("page/search_listing");
					$this->load->view("home/footer");
				}
				
			}
			else{
				redirect('page/search_page');
			}
		}
	}
	
}