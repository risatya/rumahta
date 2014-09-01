<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rumahtadotcom extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_admin');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index(){
		if($this->session->userdata('admin_logged_in') == false){
			$this->login();
		}
		else{
			$this->cpanel();
		}
	}
	
	public function login($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			$data['message'] = $message;
			$this->load->view("admin/header");
			$this->load->view("admin/login",$data);
			$this->load->view("home/footer");
		}
		else{
			$this->index();
		}
	}
	
	public function validate_login(){
		if($this->session->userdata('admin_logged_in') == false){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','', 'htmlentities|strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('password','', 'htmlentities|strip_tags|trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$message = "Login gagal. Maaf username atau password yang anda masukkan salah.";
				$this->login($message);
			}
			else{
				$stat = $this->mdl_admin->validateLogin();
				if($stat == 1){
					$id = $this->mdl_admin->getIDAdminByUsername();
					$loginData = array();
					$loginData = array(
						"admin_logged_in"=>true,
						"id_admin"=>$id[0]->id_admin,
						"username"=>$this->input->post('username'),
					);
					$this->session->set_userdata($loginData);
					redirect("rumahtadotcom/cpanel");
				}
				else if($stat == 2){
					$message = "Akun Anda Non Aktif";
					$this->login($message);
				}
				else{
					$message = "Username atau Password invalid";
					$this->login($message);
				}
			}
		}
		else{
			$this->cpanel();
		}
	}
	
	public function cpanel(){
		if($this->session->userdata('admin_logged_in') == false){
			$this->login();
		}
		else{
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data statistik pemasangan listing.
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 11; $x>=0; $x--){
				$getDate = mktime(0,0,0, date("m") ,date("d")-$x , date("Y"));
				$data['statistik'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik'][$count]['listing'] = $this->mdl_admin->getListingSubmitStatistik(date("Y-m-d H:i:s",$getDate));
				$data['statistik'][$count]['member'] = $this->mdl_admin->getMemberStatistik(date("Y-m-d H:i:s",$getDate));
				$count++;
			}
			
			// print_r($data['admin']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/cpanel",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function logout(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect('home/index');
		}
		else{
			$loginData = array();
			$this->session->sess_destroy();
			$loginData = array(
				"admin_logged_in"=>false,
				"id_admin"=>null,
				"username"=>null,
			);
			$this->session->set_userdata($loginData);
			redirect('rumahtadotcom/index');
		}
	}
	
}