<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_manager extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_admin');
		$this->load->model('mdl_page_manager');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['page_list'] = $this->mdl_page_manager->getAllPage();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			//$this->load->view("admin/news/submenu_news",$data);
			$this->load->view("admin/page/all_page",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function new_page($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/page/new_page",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function submit_page(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('nama','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('isi','', 'htmlentities|strip_tags|trim|min_length[20]|xss_clean');
		
			if ($this->form_validation->run() == FALSE){
				$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki halaman yang ingin dibuat.";
				$this->new_page($message);
			}
			else{
				$insertData = array(
					"title" => $this->input->post('title'),
					"nama" => $this->input->post('nama'),
					"content" => $this->input->post('isi')
				);
				// insert data ke database..
				$this->mdl_page_manager->insertPage($insertData);
				
				$message = "Halaman telah di buat. ";
				$this->index($message); 
			}
		}
	}
	
	public function page_detail($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_page_manager->cekPageByID($id);
			if($cek){
				$data['message'] = $message;
				$data['admin'] = $this->mdl_admin->getAdminProfile();
				$data['page_detail'] = $this->mdl_page_manager->getPageDetailByID($id);
				
				// print_r($data['news_detail']);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/page/page_detail",$data);
				$this->load->view("admin/footer");
			}
			else{
				$this->index();
			}
		}
	}
	
	public function delete($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_page_manager->cekPageByID($id);
			if($cek){
				$this->mdl_page_manager->deletePage($id);
				$message = "Halaman telah dihapus";
				$this->index($message);
			}
			else{
				$this->indeX();
			}
		}
	}
	
	public function edit($id,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_page_manager->cekPageByID($id);
			if($cek){
				$data['message'] = $message;
				$data['admin'] = $this->mdl_admin->getAdminProfile();
				$data['page_detail'] = $this->mdl_page_manager->getPageDetailByID($id);
				
				// print_r($data['news_detail']);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/page/page_edit",$data);
				$this->load->view("admin/footer");
			}
			else{
				$this->index();
			}
		}
	}
	
	public function do_edit($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('nama','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('isi','', 'htmlentities|strip_tags|trim|min_length[20]|xss_clean');
		
			if ($this->form_validation->run() == FALSE){
				$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki halaman yang ingin dibuat.";
				$this->edit($id,$message);
			}
			else{
				$updateData = array(
					"title" => $this->input->post('title'),
					"nama" => $this->input->post('nama'),
					"content" => $this->input->post('isi'),
				);
				//update data ke database..
				$this->mdl_page_manager->updatePage($id, $updateData);
				$message = "Halaman telah di edit. ";
				$this->index($message);
			}
		}
	}

}