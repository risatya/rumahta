<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_manager extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_admin');
		$this->load->model('mdl_admin_manager');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['admin_list'] = $this->mdl_admin_manager->getAllAdmin();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			//$this->load->view("admin/paket/submenu_banner",$data);
			$this->load->view("admin/admin/all_admin",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function activate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_admin_manager->cekAdminByID($id);
			if($cek == true && $id != 1){
				$updateData = array(
					"status" => 1
				);
				$this->mdl_admin_manager->updateStatusAdmin($id,$updateData);
				$message = "admin telah diaktifkan";
				$this->index($message);
			}
			else{
				$this->index();
			}
		}
	}
	
	public function nonactivate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_admin_manager->cekAdminByID($id);
			if($cek == true && $id != 1){
				$updateData = array(
					"status" => 0
				);
				//update status testimoni jadi 1..
				$this->mdl_admin_manager->updateStatusAdmin($id,$updateData);
				$message = "admin telah di nonaktifkan";
				$this->index($message);
			}
			else{
				$this->index();
			}
		}
	}
	
	public function new_admin(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('username','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean|is_unique[tbl_admin.username]');
			$this->form_validation->set_rules('password','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('password2','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|matches[password]|xss_clean');
			$this->form_validation->set_rules('email','', 'htmlentities|strip_tags|trim|required|max_length[100]|valid_email|xss_clean|is_unique[tbl_user.email]');
			$this->form_validation->set_rules('nohp','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[200]|xss_clean');
		
			if ($this->form_validation->run() == FALSE){
				$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki data admin yang ingin dibuat.";
				$this->index($message);
			}
			else{
				$admin_photo = "";
				
				$this->load->library('upload');
				$this->load->library('picture');
				//if admin photo exist [atribute_value][atribute]...
				if (!empty($_FILES['admin_photo']['name'])){
					$config['upload_path'] = './file/img/admin/';
					$config['allowed_types'] = 'jpg|png|gif';
					$config['max_size'] = '6000';
					$config['max_width']  = '5000';
					$config['max_height']  = '5000'; 
					$this->upload->initialize($config);
					//if member photo upload success...
					if ($this->upload->do_upload('admin_photo')){
						$this->load->library('picture');
						$data_photo 	= array('upload_data' => $this->upload->data());
						$admin_photo = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],150,150);
					}
					else{
						$message = "<strong>Upload foto admin gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
						$this->index($message);
					}
				}
				//insert admin data ti tbl_admin in database..
				$insertData = array(
					"nama" => $this->input->post('nama'),
					"username" => $this->input->post('username'),
					"password" => sha1($this->input->post('password')),
					"email" => $this->input->post('email'),
					"alamat" => $this->input->post('alamat'),
					"hp" => $this->input->post('hp'),
					"admin_photo" => $admin_photo,
					"status" => 1,
					"level" => 2
				);
				$this->mdl_admin_manager->insertNewAdmin($insertData);
				
				$message = 'Admin baru telah ditambahkan';
				$this->index($message);
			}
		}
	}
	
	public function admin_detail($id,$message=""){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data admin...
			$data['admin_profile'] = $this->mdl_admin_manager->getAdminDetail($id);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/admin/admin_detail",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function delete($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_admin_manager->cekAdminByID($id);
			if($cek){
				$admin_profile = $this->mdl_admin_manager->getAdminDetail($id);
				if($this->session->userdata('id_admin') != $id && $admin_profile[0]->level != 1){
					$this->mdl_admin_manager->deleteAdmin($id);
					$message = "Admin telah dihapus";
					$this->index($message);
				}
				else{
					$message = "Penghapusan admin gagal.";
					$this->index($message);
				}
			}
			else{
				$this->index();
			}
		}
	}
	
	public function edit($id, $message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data admin...
			$data['admin_profile'] = $this->mdl_admin_manager->getAdminDetail($id);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/admin/edit_admin",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function do_edit($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_admin_manager->cekAdminByID($id);
			if($cek){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('nama','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
				if($this->input->post('password') != null){
					$this->form_validation->set_rules('password','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[100]|xss_clean');
					$this->form_validation->set_rules('password2','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[100]|matches[password]|xss_clean');
				}
				$this->form_validation->set_rules('email','', 'htmlentities|strip_tags|trim|required|max_length[100]|valid_email|xss_clean|is_unique[tbl_user.email]');
				$this->form_validation->set_rules('hp','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[20]|xss_clean');
				$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[200]|xss_clean');
				
				if ($this->form_validation->run() == FALSE){
					$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki data admin yang ingin dibuat.";
					$this->index($message);
				}
				else{
					if($this->input->post('password') != null){
						$updateData = array(
							"nama" => $this->input->post("nama"),
							"email" => $this->input->post("email"),
							"hp" => $this->input->post("hp"),
							"alamat" => $this->input->post("alamat"),
							"password" => sha1($this->input->post("password"))
						);
					}
					else{
						$updateData = array(
							"nama" => $this->input->post("nama"),
							"email" => $this->input->post("email"),
							"hp" => $this->input->post("hp"),
							"alamat" => $this->input->post("alamat"),
						);
					}
					$this->mdl_admin_manager->updateAdmin($updateData,$id);
					$message = "Data Admin telah diedit";
					$this->admin_detail($id,$message);
				}			
			}
			else{
				$this->index();
			}
		}
	}
	

}