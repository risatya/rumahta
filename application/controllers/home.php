<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_member');
		$this->load->model('mdl_listing');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index(){
		
		
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			//start premium listing
			$data['premium_listing'] = $this->mdl_listing->getPremiumListingForPage(5,0);
			//ambil cover foto masing - masing listing premium.


			
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/page/all_nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo;';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);

			if($start_page === 0){
				$data['list_listing'] = $this->mdl_listing->getListingForPage(10,0);
			}
			else{
				$data['list_listing'] = $this->mdl_listing->getListingForPage($config['per_page'],0);
			}
			


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
	
	
	public function signup($message=''){
		if($this->session->userdata("logged_in") == false){
			$data['message'] = $message;
			$data['banner'] = $this->session->userdata('bannerData');
			
			$this->load->library('captcha');
			$data['captcha'] = $this->captcha->generateCaptcha();
			$data['provinsi'] = $this->mdl_home->selectAll('tbl_provinsi_indo');
			$data['kabupaten'] = $this->mdl_home->selectAll('tbl_kab_indo');
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$this->load->model('mdl_page');
			$data['copyright'] = $this->mdl_page->getPageDetail(20);
		
			$this->load->view("home/header");
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("home/signup",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
		else{
			redirect("member/index");
		}
	}
	public function validate_signup($key){
		if($this->session->userdata("logged_in") == false){
			//Validasi field form signup ...
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean|is_unique[tbl_user.username]');
			$this->form_validation->set_rules('password','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('password2','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|matches[password]|xss_clean');
			$this->form_validation->set_rules('nama','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('email','', 'htmlentities|strip_tags|trim|required|max_length[100]|valid_email|xss_clean|is_unique[tbl_user.email]');
			$this->form_validation->set_rules('jk','', 'htmlentities|strip_tags|trim|required|max_length[5]|xss_clean');
			$this->form_validation->set_rules('nohp','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('notelp','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('fax','', 'htmlentities|strip_tags|trim|min_length[5]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('register_as','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[20]|xss_clean');
			if($this->input->post('register_as') != 'individu'){
				$this->form_validation->set_rules('company_name','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			}
			else{
				$this->form_validation->set_rules('company_name','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			}
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('kab','', 'htmlentities|strip_tags|trim|required|min_length[2]|max_length[5]|xss_clean');
			$this->form_validation->set_rules('provinsi','', 'htmlentities|strip_tags|trim|required|max_length[5]|xss_clean');
			
			//Cek / validasi captcha ...
			$this->load->library('captcha');
			$captchaCheck = $this->captcha->checkAnswer($key,$this->input->post('answer'));
			
			//Validasi form ...
			if ($this->form_validation->run() == FALSE){
				$message = "<strong>Pengisian form invalid .</strong> Silakan perbaiki data anda.";
				$this->signup($message);
			}
			else if($this->input->post('agree') == null){
				$message = "<strong>Pendaftaran gagal .</strong> anda harus menyetujui semua peraturan dan ketentuan untuk mendaftar sebagai member.";
				$this->signup($message);
			}
			else if($captchaCheck == false){
				$message = "<strong>Pengisian form invalid .</strong> Jawaban verifikasi yang anda masukkan salah.";
				$this->signup($message);
			}
			else{
				//deklarasi variabel buat nama file foto member dan logo perusahaan ...
				$member_photo = "";
				$company_logo = "";
				
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
					}
					else{
						$message = "<strong>Upload foto profil gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
						$this->signup($message);
					}
				}
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
					}
					else{
						$message = "<strong>Upload logo perusahaan gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
						$this->signup($message);
					}
				}
				
				//ambil data nama kabupaten dan nama provinsi.
				$nama_kab = $this->mdl_home->getKabByID($this->input->post('kab'));
				$nama_prov = $this->mdl_home->getProvByID($this->input->post('provinsi'));
				$insertData = array(
					"nama" => $this->input->post('nama'),
					"username" => $this->input->post('username'),
					"password" => sha1($this->input->post('password')),
					"email" => $this->input->post('email'),
					"hp" => $this->input->post('nohp'),
					"alamat" => $this->input->post('alamat'),
					"telepon" => $this->input->post('notelp'),
					"fax" => $this->input->post('fax'),
					"jk" => $this->input->post('jk'),
					"user_photo" => $member_photo,
					"id_kabupaten" => $this->input->post('kab'),
					"id_provinsi" => $this->input->post('provinsi'),
					"kab" => $nama_kab[0]->nama_kabupaten,
					"provinsi" => $nama_prov[0]->nama_provinsi,
					"register_as" => $this->input->post('register_as'),
					"company_name" => $this->input->post('company_name'),
					"company_photo" => $company_logo,
					"status" => 0,
					"verifikasi" => sha1($this->input->post('username')),
				);
			
				//send email verifikasi ...
			
				$emailconfig = array(
					'sendto' => $this->input->post('email'),
					'verification_key' => sha1($this->input->post('username')),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				
				$this->load->library('invoice');
				
				if($this->invoice->verifikasi_signup($emailconfig)){
					$this->mdl_home->insertNewMember($insertData);
					redirect('home/signup_confirm');
				}
				else{
					$message="<strong>Pendaftaran gagal.</strong> Kami gagal mengirimkan email verifikasi ke email anda. pastikan email yang anda masukkan valid, atau gunakan email alternatif lainnya.";
					$this->signup($message);
				}
			}
		}
		else{
			redirect("member/index");
		}
	}
	public function signup_confirm(){
		if($this->session->userdata("logged_in") == false){
			$data['banner'] = $this->session->userdata('bannerData');
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$this->load->view("home/header");
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("home/signup_confirm");
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
		else{
			redirect("member/index");
		}
	}
	public function verifikasi($verifikasi){
		if($this->session->userdata("logged_in") == false){
			$verification_code = htmlentities(strip_tags($verifikasi));
			// echo $verification_code;
			$validate = $this->mdl_home->checkVerificationCode($verification_code);
			if($validate == 1){
				$this->mdl_home->activateMember($verification_code);
				$id = $this->mdl_home->getIDByVerCode($verification_code);
				
				//ambil data quota listing untuk paket gratis.
				$quota_gratis = $this->mdl_home->getFreeQuota();
				
				//insert data paket user..
				$insertData = array(
					"id_info_paket" => 1,
					"id_user" => $id[0]->id_user,
					"status" => 1,
					"quota" => $quota_gratis[0]->maks_listing
				);
				$this->mdl_home->insertDefaultPaket($insertData);
				$message = "Selamat datang ! akun anda telah aktif sekarang, silakan login menggunakan username dan password anda.";
				$this->login($message);
			}
			else if($validate == 2){
				$message = "Anda telah melakukan verifikasi sebelumnya. Akun anda telah aktif, silakan login.";
				$this->login($message);
			}
			else{
				$this->signup();
			}
		}
		else{
			redirect("member/index");
		}
	}
	public function login($message=''){
		if($this->session->userdata("logged_in") == false){
			$data['message'] = $message;
			$data['banner'] = $this->session->userdata('bannerData');
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$this->load->view("home/header");
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("home/login",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
		else{
			redirect("member/index");
		}
	}
	public function validate_login(){
		if($this->session->userdata("logged_in") == false){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','', 'htmlentities|strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('password','', 'htmlentities|strip_tags|trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$message = "Login gagal. Maaf username atau password yang anda masukkan salah.";
				$this->login($message);
			}
			else{
				$cek = $this->mdl_home->validateLogin();
				if($cek == "valid"){
					$id = $this->mdl_home->getIDMember($this->input->post('username'));
					$loginData = array(
						"logged_in"=>true,
						'id_user'=>$id[0]->id_user,
						"username"=>$this->input->post('username'),
					);
					$this->session->set_userdata($loginData);
					redirect('member/index');
				}
				else if($cek == "unconfirm"){
					$message = "Terima Kasih! Kami telah mengirimkan link verifikasi ke email anda. silakan cek email anda untuk mengaktifkan akun member.";
					$this->login($message);
				}
				else{
					$message = "Login gagal. Maaf username atau password yang anda masukkan salah.";
					$this->login($message);
				}
			}
		}
		else{
			redirect("member/index");
		}
	}
	public function logout(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$loginData = array(
				"logged_in"=>false,
				"username"=>'',
			);
			$this->session->set_userdata($loginData);
			redirect('home/index');
		}
	}
	public function user_url(){
		$this->load->library('user_agent');
		if($this->agent->is_mobile()){
			redirect('http://rumahta.com/m');
		}
		else{
			$userURL = $this->uri->segment(1);
			$cekURL = $this->mdl_home->cekURLUser($userURL);
			if($cekURL){
				//ambil id_user di tbl_url sesuai dengan url yanbg diketikkan
				$datauser = $this->mdl_home->getUserDataByURL($this->uri->segment(1));
				//ambil data user...
				$data['user'] = $this->mdl_member->getMemberProfileByID($datauser[0]->id_user);
				
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
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
				$this->load->view("page/user_profile",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");	
				
			}
			else{
				show_404();
			}
		}
	}
	public function user($url){
		$this->load->library('user_agent');
		if($this->agent->is_mobile()){
			redirect('http://rumahta.com/m');
		}
		else{
			$userURL = $url;
			$cekURL = $this->mdl_home->cekURLUser($userURL);
			if($cekURL){
				//ambil id_user di tbl_url sesuai dengan url yanbg diketikkan
				$datauser = $this->mdl_home->getUserDataByURL($url);
				//ambil data user...
				$data['user'] = $this->mdl_member->getMemberProfileByID($datauser[0]->id_user);
				
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
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
				$this->load->view("page/user_profile",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");	
				
			}
			else{
				show_404();
			}
		}
	}
	
	public function forgot($message=''){
		if($this->session->userdata("logged_in") == false){
			$data['message'] = $message;
			$data['banner'] = $this->session->userdata('bannerData');
			
			$this->load->library('captcha');
			$data['captcha'] = $this->captcha->generateCaptcha();
			$data['provinsi'] = $this->mdl_home->selectAll('tbl_provinsi_indo');
			$data['kabupaten'] = $this->mdl_home->selectAll('tbl_kab_indo');
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$this->load->model('mdl_page');
			$data['copyright'] = $this->mdl_page->getPageDetail(20);
		
			$this->load->view("home/header");
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("home/forgot",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
		else{
			redirect("member/index");
		}
	}
	
	public function validate_forgot(){
		if($this->session->userdata("logged_in") == false){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','', 'trim|required|min_length[5]|max_length[200]|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$message = "Masukan data dengan benar.";
				$this->forgot($message);
			}
			else{
				$cek = $this->mdl_home->checkRow('tbl_user',array('username' => $this->input->post('username')));
				if($cek){
					
					$userdata = $this->mdl_home->select('tbl_user',array('username' => $this->input->post('username')));
					//generate new password..
					$uid = uniqid("", true);
					$data_user = "";
					$data_user .= $_SERVER['REQUEST_TIME'];
					$data_user .= $_SERVER['HTTP_USER_AGENT'];
					$data_user .= $_SERVER['LOCAL_ADDR'];
					$data_user .= $_SERVER['LOCAL_PORT'];
					$data_user .= $_SERVER['REMOTE_ADDR'];
					$data_user .= $_SERVER['REMOTE_PORT'];
					$hash = strtoupper(hash('ripemd128', $uid . $guid . sha1($data)));
					$newpass = substr($hash,0,8);
					
					//update password in database member..
					$this->mdl_home->update("id_user",$userdata[0]->id_user,"tbl_user",array("password"=>sha1($newpass)));
				
					//kirim email pemberitahuan password yang baru.
					$sendto  = $userdata[0]->email;
					$subject  = "Reset Password Rumahta.com";
					$message = "
						Terkait dengan pemberitahuan anda pada fitur 'Lupa password',
						kami telah mereset password lama anda.
						
						Anda dapat login dengan :
						username: ".$userdata[0]->username."
						password: ".$newpass."
						
						Regards,
						Rumahta.com
					";
					
					$this->load->library('email');
					$this->email->from('mail@rumahta.com','rumahta.com');
					$this->email->to($sendto); 
					$this->email->subject($subject);
					$this->email->message($message);	
					
					if($this->email->send()){
						$message = "Kami telah mengirimkan password anda yang baru ke email. <br/> silakan cek inbox email anda. cek juga pada spam apabila anda tidak menemukan pesan dari kami di inbox.";
						$this->login($message);
					}
					else{
						$message = "kami gagal mengirimkan password anda yang baru ke email. harap masukkan email yang valid.";
						$this->forgot($message);
					}
				}
				else{
					$message = "username yang anda masukkan tidak valid. <br/> masukkan username yang anda gunakan untuk mendaftar di rumahta.com.";
					$this->forgot($message);
				}
			}
		}
		else{
			redirect("member/index");
		}
	}
	
	public function tes_email(){
		
		$username = "hengky";
		
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";

		$this->email->initialize($config);
		
		$sendto  = "hengkymulyono301@gmail.com";
		$subject  = "Reset Password Rumahta.com";
		$message = "
			Terkait dengan pemberitahuan anda pada fitur 'Lupa password',
			kami telah mereset password lama anda.
			
			teeesssss, halo ".$username."
			
			Regards,
			Rumahta.com
		";
		
		$this->email->from('mail@rumahta.com','rumahta.com');
		$this->email->to($sendto); 
		$this->email->subject($subject);
		$this->email->message($message);
		
		if($this->email->send()){
			echo"berhasil";
		}
		else{
			echo "gagal. kampret.";
		}
	}
}