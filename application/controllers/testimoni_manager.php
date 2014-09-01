<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimoni_manager extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_admin');
		$this->load->model('mdl_testi_manager');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->all_testi();
		}
	}
	
	public function all_testi($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			$data['all_testi'] = $this->mdl_testi_manager->getAllTestimoni();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			// $this->load->view("admin/paket/submenu_banner",$data);
			$this->load->view("admin/testi/all_testi",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function activate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_testi_manager->cekTestimoniByID($id);
			if($cek){
				$updateData = array(
					"status_testi" => 1
				);
				//update status testimoni jadi 1..
				$this->mdl_testi_manager->updateStatusTestimoni($id,$updateData);
				$message = "testimoni telah diaktifkan";
				$this->all_testi($message);
			}
			else{
				$this->all_testi();
			}
		}
	}
	
	public function nonactivate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_testi_manager->cekTestimoniByID($id);
			if($cek){
				$updateData = array(
					"status_testi" => 0
				);
				//update status testimoni jadi 1..
				$this->mdl_testi_manager->updateStatusTestimoni($id,$updateData);
				$message = "testimoni telah di nonaktifkan";
				$this->all_testi($message);
			}
			else{
				$this->all_testi();
			}
		}
	}
	
}