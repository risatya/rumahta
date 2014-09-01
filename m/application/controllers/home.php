<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_member');
		$this->load->model('mdl_listing');
    }
	public function index(){
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
			$config['next_link'] 	= ' Next &raquo;';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);

			$data['list_listing'] = $this->mdl_listing->getListingForPage($config['per_page'],0);
			
			//ambil cover foto masing - masing listing premium.
			$x = 0;
			$data['cover_listing'] = array();
			foreach($data['list_listing'] as $item):
				$cover = $this->mdl_home->getCoverPhotoByID($item->id_listing_member);
				$data['cover_listing'][$x] = $cover[0]->listing_photo_list;
				$x++;
			endforeach;
			
			/***************************************************/
			//tambah statistik jumlah pengunjung web di database.
			
			$getDate = mktime(0,0,0, date("m") ,date("d") , date("Y"));
			$this->load->model('mdl_statistik');
			$cekDate = $this->mdl_statistik->cekStatistikDate(date("Y-m-d H:i:s",$getDate));
			// echo $now."<br/>";
			if($cekDate){
				//ambil data pengunjung yang lama di database..
				$visitor = $this->mdl_statistik->getVisitorCount(date("Y-m-d H:i:s",$getDate));
				//update jumlah pengunjung di database + 1..
				$updateData = array(
					"counter" => $visitor[0]->counter + 1
				);
				$this->mdl_statistik->updateVisitorCount($updateData,date("Y-m-d H:i:s",$getDate));
			}
			else{
				//insert counter visitor baru ke database.
				$insertData = array(
					"tipe_statistik" => 3,
					"ket" => "Jumlah Pengunjung Web",
					"tanggal" => date("Y-m-d H:i:s",$getDate),
					"counter" => 1
				);
				$this->mdl_statistik->insertVisitorCount($insertData);
			}
			
			/****************************************************/
			
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
	
	public function user_url(){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$userURL = $this->uri->segment(1);
			$cekURL = $this->mdl_home->cekURLUser($userURL);
			if($cekURL){
				//ambil id_user di tbl_url sesuai dengan url yanbg diketikkan
				$datauser = $this->mdl_home->getUserDataByURL($this->uri->segment(1));
				//ambil data user...
				$data['user'] = $this->mdl_member->getMemberProfileByID($datauser[0]->id_user);
				
				$total_row = $this->mdl_listing->getCountListingByIDUser($datauser[0]->id_user);
				
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/home/user/'.$userURL.'/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 4;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo; ';
				$config['prev_link'] 	= ' &laquo; Prev';
				$config['uri_segment'] 	= 4;
				$this->pagination->initialize($config);
				$data['list_listing'] = $this->mdl_listing->getListingByIDUser($datauser[0]->id_user, $config['per_page'], 0);
				
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
					$this->load->view("page/user_listing");
					$this->load->view("home/footer");	
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$this->load->view("home/header",$data);
					$this->load->view("page/user_listing");
					$this->load->view("home/footer");
				}
				
			}
			else{
				show_404();
			}
		}
	}
	
	public function user($url){
		$this->load->library('user_agent');
		if(! $this->agent->is_mobile()){
			redirect('http://rumahta.com/');
		}
		else{
			$userURL = $url;
			$cekURL = $this->mdl_home->cekURLUser($userURL);
			if($cekURL){
				//ambil id_user di tbl_url sesuai dengan url yanbg diketikkan
				$datauser = $this->mdl_home->getUserDataByURL($url);
				//ambil data user...
				$data['user'] = $this->mdl_member->getMemberProfileByID($datauser[0]->id_user);
				
				$total_row = $this->mdl_listing->getCountListingByIDUser($datauser[0]->id_user);
				
				$this->load->library('pagination');
				$config['base_url'] 	= base_url().'index.php/home/user/'.$userURL.'/';
				$config['total_rows'] 	= $total_row;
				$config['per_page'] 	= 4;
				$config['first_link'] 	= 'First';
				$config['last_link'] 	= 'Last';
				$config['next_link'] 	= ' Next &raquo; ';
				$config['prev_link'] 	= ' &laquo; Prev';
				$config['uri_segment'] 	= 4;
				$this->pagination->initialize($config);
				$data['list_listing'] = $this->mdl_listing->getListingByIDUser($datauser[0]->id_user, $config['per_page'], $this->uri->segment(4));
				
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
					$this->load->view("page/user_listing");
					$this->load->view("home/footer");	
				}
				else{
					$data['member'] = $this->mdl_member->getUserHeaderData();
					$this->load->view("home/header",$data);
					$this->load->view("page/user_listing");
					$this->load->view("home/footer");
				}
				
			}
			else{
				show_404();
			}
		}
	}
}