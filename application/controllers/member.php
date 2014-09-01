<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_listing');
		$this->load->model('mdl_member');
		$this->load->model('mdl_home');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();

			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			//$data['info_paket'] = $this->mdl_listing->getPaketInfo();
			$data['member_profile'] = $this->mdl_member->getMemberData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			//ambil data statistik.
			$this->load->model('mdl_statistik');
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 6; $x>=0; $x--){
				$getDate = mktime(0,0,0, date("m") ,date("d")-$x , date("Y"));
				$data['statistik'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik'][$count]['visitor'] = $this->mdl_statistik->getAllStatistikByDate(date("Y-m-d H:i:s",$getDate));
				$count++;
			}
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("member/member_profil",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	public function edit_profile($message=''){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$data['message'] = $message;
			$this->load->library('banner');
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$data['member_profile'] = $this->mdl_member->getMemberData();
			$data['provinsi'] = $this->mdl_home->selectAll('tbl_provinsi_indo');
			$data['kabupaten'] = $this->mdl_home->selectAll('tbl_kab_indo');
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("member/edit_profil",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	public function do_edit(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			//Validasi field form signup ...
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('email','', 'htmlentities|strip_tags|trim|required|max_length[100]|valid_email|xss_clean');
			$this->form_validation->set_rules('jk','', 'htmlentities|strip_tags|trim|required|max_length[5]|xss_clean');
			$this->form_validation->set_rules('nohp','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('notelp','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('fax','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('register_as','', 'htmlentities|strip_tags|trim|required|min_length[2]|max_length[20]|xss_clean');
			if($this->input->post('register_as') != 'individu'){
				$this->form_validation->set_rules('company_name','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			}
			$this->form_validation->set_rules('kab','', 'htmlentities|strip_tags|trim|required|min_length[2]|max_length[5]|xss_clean');
			$this->form_validation->set_rules('provinsi','', 'htmlentities|strip_tags|trim|required|max_length[5]|xss_clean');
			
			if ($this->form_validation->run() == FALSE){
				$message = "<strong>Pengisian form invalid .</strong> Silakan perbaiki data anda.";
				//$message = validation_errors();
				$this->edit_profile($message);
			}
			else{
				$old_logo = $this->mdl_member->getOldLogo();
				$company_logo = $old_logo[0]->company_photo;
				
				$this->load->library('upload');
				$this->load->library('picture');
				
				if (!empty($_FILES['company_logo']['name'])){
					$config['upload_path'] = './file/img/company/';
					$config['allowed_types'] = 'jpg|png|gif';
					$config['max_size'] = '6000';
					$config['max_width']  = '5000';
					$config['max_height']  = '5000'; 
					$this->upload->initialize($config);
					//if member photo upload success...
					if ($this->upload->do_upload('company_logo')){
						$data_photo 	= array('upload_data' => $this->upload->data());
						$company_logo = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],150,150);
						if($old_logo[0]->company_photo != null){
							unlink("file/img/company/".$old_logo[0]->company_photo);
						}
					}
					else{
						$message = "<strong>Upload logo perusahaan gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
						$this->edit_profile($message);
					}
				}
				
				//ambil data nama kabupaten dan nama provinsi.
				$nama_kab = $this->mdl_home->getKabByID($this->input->post('kab'));
				$nama_prov = $this->mdl_home->getProvByID($this->input->post('provinsi'));
				$updateData = array(
					"nama" => $this->input->post('nama'),
					"email" => $this->input->post('email'),
					"hp" => $this->input->post('nohp'),
					"alamat" => $this->input->post('alamat'),
					"telepon" => $this->input->post('notelp'),
					"fax" => $this->input->post('fax'),
					"jk" => $this->input->post('jk'),
					"id_kabupaten" => $this->input->post('kab'),
					"id_provinsi" => $this->input->post('provinsi'),
					"kab" => $nama_kab[0]->nama_kabupaten,
					"provinsi" => $nama_prov[0]->nama_provinsi,
					"register_as" => $this->input->post('register_as'),
					"company_name" => $this->input->post('company_name'),
					"company_photo" => $company_logo,
				);
			
				$this->mdl_member->updateMember($updateData);
				$message = "<strong>Data telah di update .</strong>";
				$this->edit_profile($message);
			}
		}
	}
	function edit_pp(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			//deklarasi variabel buat nama file foto member...
			$old_logo = $this->mdl_member->getOldPhoto();
			$member_photo = $old_logo[0]->user_photo;
			
			$this->load->library('upload');
			$this->load->library('picture');
			//if user photo exist [atribute_value][atribute]...
			if (!empty($_FILES['member_photo']['name'])){
				$config['upload_path'] = './file/img/pp/';
				$config['allowed_types'] = 'jpg|png|gif';
				$config['max_size'] = '6000';
				$config['max_width']  = '5000';
				$config['max_height']  = '5000'; 
				$this->upload->initialize($config);
				//if member photo upload success...
				if ($this->upload->do_upload('member_photo')){
					$data_photo 	= array('upload_data' => $this->upload->data());
					$member_photo = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],150,150);
					if($old_logo[0]->user_photo != null){
						unlink("file/img/pp/".$old_logo[0]->user_photo);
					}
					$updateData = array(
						"user_photo" => $member_photo
					);
					$this->mdl_member->updateMember($updateData);
					$message = "<strong>Foto Profil telah di update .</strong>";
					$this->edit_profile($message);
				}
				else{
					$message = "<strong>Upload foto profil gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
					$this->edit_profile($message);
				}
			}
			else{
				$message = 'foto tidak ditemukan';
				$this->edit_profile($message);
			}
		}
	}
	function edit_password(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('newpassword','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$message = "<strong>Edit Password gagal.</strong> Masukkan password dengan benar. Minimal 5 karakter.";
				$this->edit_profile($message);
			}
			else{
				$old_password = $this->mdl_member->getPassword();
				if(sha1($this->input->post('password')) == $old_password[0]->password){
					$updateData = array(
						"password" => sha1($this->input->post('newpassword'))
					);
					$this->mdl_member->updateMember($updateData);
					$message = "<strong>Password anda telah di update / diganti</strong>";
					$this->edit_profile($message);
				}
				else{
					$message = '<strong>Edit password gagal. </strong> Password lama yang anda masukkan salah';
					$this->edit_profile($message);
				}
			}
		}
	}
	public function url_member($message=''){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$data['message'] = $message;
			$this->load->library('banner');
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$url = $this->mdl_member->getShortURL();
			$data['url'] = $url[0]->nama_url;
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("member/short_url",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	public function process_url(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$url = $this->mdl_member->getShortURL();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('url','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			if ($this->form_validation->run() == FALSE){
				if($url[0]->nama_url == null){
					$message = "<strong>Pendafataran url singkat gagal.</strong>";
				}
				else{
					$message = "<strong>Edit url singkat gagal.</strong>";
				}
				$this->url_member($message);
			}
			else{
				$urlCheck = $this->mdl_member->checkURL();
				if($urlCheck){
					if($url[0]->nama_url == null){
					$message = "<strong>Pendafataran url singkat gagal.</strong>Nama sudah terpakai. silakan gunakan nama url yang lain";
					}
					else{
						$message = "<strong>Edit url singkat gagal.</strong>Nama sudah terpakai. silakan gunakan nama url yang lain";
					}
					$this->url_member($message);
				}
				else{
					if($url[0]->nama_url == null){
						$insertData = array(
							"nama_url" => $this->input->post('url'),
							"id_user" => $this->session->userdata('id_user')
						);
						$this->mdl_member->insertNewURL($insertData);
					}
					else{
						$updateData = array(
							"nama_url" => $this->input->post('url')
						);
						$this->mdl_member->updateURL($updateData);
					}
					$message = "<strong>Pembuatan url berhasil</strong>";
					$this->url_member($message);
				}
			}
		}
	}
}