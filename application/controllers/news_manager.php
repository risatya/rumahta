<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_manager extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_admin');
		$this->load->model('mdl_news_manager');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['news_list'] = $this->mdl_news_manager->getAllNews();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			//$this->load->view("admin/news/submenu_news",$data);
			$this->load->view("admin/news/all_news",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function new_news($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/news/new_news");
			$this->load->view("admin/footer");
		}
	}
	public function submit_news(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('isi','', 'htmlentities|strip_tags|trim|required|min_length[20]|max_length[20000]|xss_clean');
		
			if ($this->form_validation->run() == FALSE){
				$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki berita yang ingin dibuat.";
				$this->new_news($message);
			}
			else{
				$photo_big = "";
				$photo_thumb = "";
				$this->load->library('upload');
				$this->load->library('picture');
				//if news photo exist [atribute_value][atribute]...
				if (!empty($_FILES['news_photo']['name'])){
					$config['upload_path'] = './file/img/news/';
					$config['allowed_types'] = 'jpg|png|gif';
					$config['max_size'] = '6000';
					$config['max_width']  = '5000';
					$config['max_height']  = '5000'; 
					$this->upload->initialize($config);
					//if member photo upload success...
					if ($this->upload->do_upload('news_photo')){
						$data_photo 	= array('upload_data' => $this->upload->data());
						//resize image and create a new small image...
						$config_img['image_library'] 	= 'gd2';
						$config_img['source_image'] 	= $data_photo['upload_data']['full_path'];
						$config_img['quality'] 		 	= 72;
						$config_img['maintain_ratio'] 	= TRUE;
						$config_img['width']	 		= 470;
						$config_img['height']	 		= 470;
						$this->load->library('image_lib', $config_img);
						$this->image_lib->resize();
						
						//make thumbnail and resize photo...
						$photo_big = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],380,260);
						$photo_thumb = $this->picture->createThumb($data_photo['upload_data']['full_path'],130,130);
					}
					else{
						$message = "<strong>Upload gambar berita gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
						$this->new_news($message);
					}
				}
				$now = date("Y-m-d H:i:s");
				$insertData = array(
					"title" => $this->input->post('title'),
					"isi" => $this->input->post('isi'),
					"tanggal" => $now,
					"status" => 1,
					"photo_thumb" => $photo_thumb,
					"photo" => $photo_big
				);
				//insert data ke database..
				$this->mdl_news_manager->insertNews($insertData);
				$message = "Berita telah di publish. ";
				$this->index($message);
			}
		}
	}
	
	public function activate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_news_manager->cekNewsByID($id);
			if($cek){
				$updateData = array(
					"status" => 1
				);
				$this->mdl_news_manager->updateStatusNews($id,$updateData);
				$message = "berita telah diaktifkan";
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
			$cek = $this->mdl_news_manager->cekNewsByID($id);
			if($cek){
				$updateData = array(
					"status" => 0
				);
				//update status news jadi 0..
				$this->mdl_news_manager->updateStatusNews($id,$updateData);
				$message = "berita telah di nonaktifkan";
				$this->index($message);
			}
			else{
				$this->index();
			}
		}
	}
	
	public function news_detail($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_news_manager->cekNewsByID($id);
			if($cek){
				$data['message'] = $message;
				$data['admin'] = $this->mdl_admin->getAdminProfile();
				$data['news_detail'] = $this->mdl_news_manager->getNewsDetailByID($id);
				
				// print_r($data['news_detail']);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/news/news_detail",$data);
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
			$cek = $this->mdl_news_manager->cekNewsByID($id);
			if($cek){
				$this->mdl_news_manager->deleteNews($id);
				$message = "Berita telah dihapus";
				$this->index($message);
			}
			else{
				$this->index();
			}
			// echo "tes";
		}
	}
	
	public function edit($id,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_news_manager->cekNewsByID($id);
			if($cek){
				$data['message'] = $message;
				$data['admin'] = $this->mdl_admin->getAdminProfile();
				$data['news_detail'] = $this->mdl_news_manager->getNewsDetailByID($id);
				
				// print_r($data['news_detail']);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/news/news_edit",$data);
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
			$this->form_validation->set_rules('isi','', 'htmlentities|strip_tags|trim|required|min_length[20]|max_length[20000]|xss_clean');
		
			if ($this->form_validation->run() == FALSE){
				$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki berita yang ingin dibuat.";
				$this->edit($id,$message);
			}
			else{
				$photo_big = "";
				$photo_thumb = "";
				$this->load->library('upload');
				$this->load->library('picture');
				//if news photo exist [atribute_value][atribute]...
				if (!empty($_FILES['news_photo']['name'])){
					$config['upload_path'] = './file/img/news/';
					$config['allowed_types'] = 'jpg|png|gif';
					$config['max_size'] = '6000';
					$config['max_width']  = '5000';
					$config['max_height']  = '5000'; 
					$this->upload->initialize($config);
					//if member photo upload success...
					if ($this->upload->do_upload('news_photo')){
						$data_photo 	= array('upload_data' => $this->upload->data());
						//resize image and create a new small image...
						$config_img['image_library'] 	= 'gd2';
						$config_img['source_image'] 	= $data_photo['upload_data']['full_path'];
						$config_img['quality'] 		 	= 72;
						$config_img['maintain_ratio'] 	= TRUE;
						$config_img['width']	 		= 470;
						$config_img['height']	 		= 470;
						$this->load->library('image_lib', $config_img);
						$this->image_lib->resize();
						
						//make thumbnail and resize photo...
						$photo_big = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],380,260);
						$photo_thumb = $this->picture->createThumb($data_photo['upload_data']['full_path'],130,130);
						
						$now = date("Y-m-d H:i:s");
						$updateData = array(
							"title" => $this->input->post('title'),
							"isi" => $this->input->post('isi'),
							"tanggal" => $now,
							"photo_thumb" => $photo_thumb,
							"photo" => $photo_big
						);
					}
					else{
						$message = "<strong>Upload gambar berita gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
						$this->edit($id,$message);
					}
				}
				else{
					$now = date("Y-m-d H:i:s");
					$updateData = array(
						"title" => $this->input->post('title'),
						"isi" => $this->input->post('isi'),
						"tanggal" => $now,
					);
				}
				//update data ke database..
				$this->mdl_news_manager->updateNews($id, $updateData);
				$message = "Berita telah di edit. ";
				$this->index($message);
			}
		}
	}

}