<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paket_listing_manager extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_member');
		$this->load->model('mdl_paket_manager');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->all_paket();
		}
	}
	
	public function all_paket($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_paket');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getAllPaket($config['per_page'],0);
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_paket",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function nextpage($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_paket');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getAllPaket($config['per_page'],$this->uri->segment(3));
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_paket",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function search_paket($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			//ambil data semua paket member...
			$total_row = $this->mdl_paket_manager->count_search($this->input->post('keyword'));
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/search_nextpage/'.$this->input->post('keyword').'/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$config['uri_segment']  = 4;
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getSearchPaket($config['per_page'],0,$this->input->post('keyword'));
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_paket",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function search_nextpage($keyword){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			//ambil data semua paket member...
			$total_row = $this->mdl_paket_manager->count_search($keyword);
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/search_nextpage/'.$keyword.'/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$config['uri_segment']  = 4;
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getSearchPaket($config['per_page'],$this->uri->segment(4),$keyword);
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_paket",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function edit_paket($id,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			$cek = $this->mdl_paket_manager->cekPaketByID($id);
			if($cek){
				$data['paket_detail'] = $this->mdl_paket_manager->getPaketDetailByID($id);
				$data['info_paket'] = $this->mdl_paket_manager->getAllInfoPaket();
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/paket/submenu",$data);
				$this->load->view("admin/paket/edit_paket",$data);
				$this->load->view("admin/footer");
			}
			else{
				$this->all_paket();
			}
		}
	}
	
	public function do_edit($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekPaketByID($id);
			if($cek){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('jenis_paket','', 'htmlentities|strip_tags|trim|required|integer|xss_clean');
				$this->form_validation->set_rules('quota','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				if ($this->form_validation->run() == FALSE){
					$message =  validation_errors()."Edit paket gagal. isikan form dengan benar.";
					$this->edit_paket($id,$message);
				}
				else{
					$updateData = array(
						"id_info_paket" => $this->input->post('jenis_paket'),
						"quota" => $this->input->post('quota')
					);
					$this->mdl_paket_manager->updatePaketMember($id,$updateData);
					$message = "paket member telah di edit.";
					$this->all_paket($message);
				}
			}
			else{
				$this->edit_paket($id);
			}
		}
	}
	
	public function delete_paket($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekPaketByID($id);
			if($cek){
				
				//cek apakah paket yang ignin dihapus paket gratis atau bukan. paket gratis tidak bisa dihapus...
				$paketDetail = $this->mdl_paket_manager->getPaketMemberByID($id);
				
				if($paketDetail[0]->id_info_paket != 1){
					$this->mdl_paket_manager->deletePaketByID($id);
					
					$message = "Paket berhasil dihapus.";
					$this->all_paket($message);
				}
				else{
					$message = "Anda tidak dapat menghapus paket gratis.";
					$this->all_paket($message);
				}
			}
			else{
				$this->all_paket();
			}
		}
	}
	
	public function konfirmasi($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'konfirmasi';
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_konfirmasi_listing');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/konfirmasi_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getAllKonfirmasiListing($config['per_page'],0);
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_konfirmasi_listing",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function konfirmasi_nextpage($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'konfirmasi';
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_konfirmasi_listing');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/konfirmasi_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getAllKonfirmasiListing($config['per_page'],$this->uri->segment(3));
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_konfirmasi_listing",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function see_konfirmasi_detail($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'konfirmasi';
			
			$cek = $this->mdl_paket_manager->cekKonfirmasiListing($id);
			
			if($cek){
				$data['konfirmasi_detail'] = $this->mdl_paket_manager->getKonfirmasiListingDetail($id);
				// print_r($data['konfirmasi_detail']);
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/paket/submenu",$data);
				$this->load->view("admin/paket/konfirmasi_detail",$data);
				$this->load->view("admin/footer");
			}
			else{
				$this->konfirmasi();
			}
		}
	}
	
	public function activate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			
			$cek = $this->mdl_paket_manager->cekKonfirmasiListing($id);
			
			if($cek){
				$confirmData = $this->mdl_paket_manager->getKonfirmasiDetailByID($id);
				//cek paket yang dipesan sudah ada di database sebelumnya atau belum...
				//jika ada, tambahkan quota paket dengan maks listing di tabel tbl_info_paket...
				//jika tidak ada, insert record baru ke tabel tbl_paket.
				$cekPaketMember = $this->mdl_paket_manager->cekPaketMember($confirmData[0]->id_user,$confirmData[0]->id_info_paket);
				if($cekPaketMember){
					$getPaketMember = $this->mdl_paket_manager->getPaketMember($confirmData[0]->id_user,$confirmData[0]->id_info_paket);
					$getPaketInfo = $this->mdl_paket_manager->getPaketInfoByID($confirmData[0]->id_info_paket);
					$updateData = array(
						"quota" => $getPaketMember[0]->quota + $getPaketInfo[0]->maks_listing
					);
					//update quota member di database...
					$this->mdl_paket_manager->updatePaketMember($getPaketMember[0]->id_paket,$updateData);
					//ganti status / field confirmed di tabel tbl_konfirmasi_listing...
					$this->mdl_paket_manager->updateStatusKonfirmasiPaket($id,array('confirmed'=>0));
					
					//hapus konfirmasi member yang telah diaktifkan..
					$this->mdl_paket_manager->deleteKonfirmasi($id);
					
					//kirim invoice ke email.
					$useremail = $this->mdl_member->getMemberProfileByID($confirmData[0]->id_user);
					//kirim email invoice..
					$emailconfig = array(
						'sendto' => $useremail[0]->email,
						'jenis_paket' => $getPaketInfo[0]->nama_paket,
						'quota' => $getPaketMember[0]->quota + $getPaketInfo[0]->maks_listing,
						'tgl_bayar' => date('d-M-Y',strtotime($confirmData[0]->tgl_bayar))
					);
					$this->load->library('invoice');
					$this->invoice->invoice_activate_listing1($emailconfig);
					
					$message = "Paket Pemesanan listing telah diaktifkan";
					$this->konfirmasi($message);
				}
				else{
					$getPaketInfo = $this->mdl_paket_manager->getPaketInfoByID($confirmData[0]->id_info_paket);
					$insertData = array(
						"id_info_paket" => $confirmData[0]->id_info_paket,
						"id_user" => $confirmData[0]->id_user,
						"status" => 1,
						"quota" => $getPaketInfo[0]->maks_listing
					);
					//insert record baru ke tabel tbl_paket..
					$this->mdl_paket_manager->insertPaketMember($insertData);
					//ganti status / field confirmed di tabel tbl_konfirmasi_listing...
					$this->mdl_paket_manager->updateStatusKonfirmasiPaket($id);
					
					//kirim invoice ke email.
					$useremail = $this->mdl_member->getMemberProfileByID($confirmData[0]->id_user);
					//kirim email invoice..
					$emailconfig = array(
						'sendto' => $useremail[0]->email,
						'jenis_paket' => $getPaketInfo[0]->nama_paket,
						'quota' => $getPaketInfo[0]->maks_listing,
						'tgl_bayar' => date('d-M-Y',strtotime($confirmData[0]->tgl_bayar))
					);
					$this->load->library('invoice');
					$this->invoice->invoice_activate_listing2($emailconfig);
					
					//hapus konfirmasi member yang telah diaktifkan..
					$this->mdl_paket_manager->deleteKonfirmasi($id);
					
					$message = "Paket Pemesanan listing telah diaktifkan";
					$this->konfirmasi($message);
				}
			}
			else{
				$this->konfirmasi();
			}
		}
	}
	
	public function paket_detail($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'paket_detail';
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_info_paket');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/paket_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getAllPaketDetail($config['per_page'],0);
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_paket_listing_detail",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function paket_nextpage($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'paket_detail';
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_info_paket');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/paket_listing_manager/paket_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_paket'] = $this->mdl_paket_manager->getAllPaketDetail($config['per_page'],$this->uri->segment(3));
			
			// print_r($data['all_paket']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu",$data);
			$this->load->view("admin/paket/all_paket_detail",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function edit($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekInfoPaket($id);
			if($cek){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('nama_paket','', 'htmlentities|strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('quota','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				if ($this->form_validation->run() == FALSE){
					$message =  validation_errors()."Edit paket gagal. isikan form dengan benar.";
					$this->paket_detail($message);
				}
				else{
					$updateData = array(
						"nama_paket" => $this->input->post('nama_paket'),
						"harga" => $this->input->post('harga'),
						"maks_listing" => $this->input->post('quota'),
						"durasi_listing" => $this->input->post('durasi')
					);
					//edit data paket di database....
					$this->mdl_paket_manager->UpdateInfoPaket($id,$updateData);
					$message =  "Edit paket berhasil.";
					$this->paket_detail($message);
				}
			}
			else{
				$this->paket_detail();
			}
		}
	}
	
	public function new_paket(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_paket','', 'htmlentities|strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('quota','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Pembuatan paket baru gagal. isikan form dengan benar.";
				$this->paket_detail($message);
			}
			else{
				$insertData = array(
					"nama_paket" => $this->input->post('nama_paket'),
					"harga" => $this->input->post('harga'),
					"maks_listing" => $this->input->post('quota'),
					"durasi_listing" => $this->input->post('durasi'),
					"status" => 1
				);
				//edit data paket di database....
				$this->mdl_paket_manager->InsertInfoPaket($insertData);
				$message =  "Paket Baru berhasil ditambahkan.";
				$this->paket_detail($message);
			}
		}
	}
	
	public function delete($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekInfoPaket($id);
			if($cek){
				$updateData = array(
					"status" => 0
				);
				//edit data paket di database....
				$this->mdl_paket_manager->UpdateInfoPaket($id,$updateData);
				$message =  "Paket telah di nonaktifkan.";
				$this->paket_detail($message);
			}
			else{
				$this->paketr_detail();
			}
		}
	}
	
}