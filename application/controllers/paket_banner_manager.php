<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paket_banner_manager extends CI_Controller {
	
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
			$this->all_banner();
		}
	}
	
	public function all_banner($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_banner';
			
			$data['banner_list'] = $this->mdl_paket_manager->getAllBannerInfo();
			
			$x = 0;
			$data['member_banner'] = array();
			foreach($data['banner_list'] as $item):
				$bannerdata = $this->mdl_paket_manager->getActiveBanner($item->id_info_banner);
				$data['member_banner'][$x]['id_info_banner'] = $item->id_info_banner;
				$data['member_banner'][$x]['nama_banner'] = $item->nama_banner;
				$data['member_banner'][$x]['posisi'] = $item->posisi;
				$data['member_banner'][$x]['id_banner'] = $bannerdata[0]->id_banner;
				$data['member_banner'][$x]['posisi_banner'] = $item->posisi;
				$x++;
			endforeach;
			
			// print_r($data['member_banner']);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu_banner",$data);
			$this->load->view("admin/paket/all_banner",$data);
			$this->load->view("admin/footer");
			
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
			
			$data['all_konfirmasi_banner'] = $this->mdl_paket_manager->getAllKonfirmasibanner();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu_banner",$data);
			$this->load->view("admin/paket/all_konfirmasi_banner",$data);
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
			
			$cek = $this->mdl_paket_manager->cekKonfirmasiBanner($id);
			
			if($cek){
				$data['konfirmasi_detail'] = $this->mdl_paket_manager->getKonfirmasiBannerDetail($id);
				// print_r($data['konfirmasi_detail']);
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/paket/submenu_banner",$data);
				$this->load->view("admin/paket/konfirmasi_detail_banner",$data);
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
			$id_banner_dummy = $this->mdl_paket_manager->getIDBannerDummyFromTblBannerDummy($id);
			$id_info_banner = $this->mdl_paket_manager->getIDInfoBannerFromTblKonfirmasi($id_banner_dummy[0]->id_banner_dummy);
			
			//cek space banner available atau engga..
			$cekBanner = $this->mdl_paket_manager->cekBannerAvailability($id_info_banner[0]->id_info_banner);
			
			//jika space banner tersedia...
			if($cekBanner){
				$detail_banner = $this->mdl_paket_manager->getBannerDummyDetail($id);
				$now =  date("Y-m-d H:i:s");
				$exp = mktime(0,0,0, date("m")+$detail_banner[0]->durasi ,date("d") , date("Y"));
				$insertData = array(
					"id_info_banner" => $detail_banner[0]->id_info_banner,
					"id_user" => $detail_banner[0]->id_user,
					"photo" => $detail_banner[0]->photo,
					"url" => $detail_banner[0]->url,
					"publish_date" => $now,
					"expired_date" => date("Y-m-d H:i:s",$exp),
					"status" => 1,
					"posisi" => ($detail_banner[0]->posisi == "top" ? 1 : ($detail_banner[0]->posisi == "side" ? 2 : 3))
				);
				
				//print_r($insertData);
				//insert data ke tabel banner untuk mengaktifkan banner.
				$this->mdl_paket_manager->activateBanner($insertData);
				
				//kirim invoice ke email.
				$useremail = $this->mdl_member->getMemberProfileByID($detail_banner[0]->id_user);
				$a = $detail_banner[0]->id_info_banner;
				$jenis_banner = ($a == 1 ? "banner atas" : (($a == 7 || $a == 8) ? "banner bawah ".($a-6) : "banner kanan ".($a-1)));
				//kirim email invoice..
				$emailconfig = array(
					'sendto' => $useremail[0]->email,
					'jenis_banner' => $jenis_banner,
					'expired_date' => date('d-M-Y',$exp),
				);
				$this->load->library('invoice');
				$this->invoice->invoice_activate_banner($emailconfig);
				
				//hapus konfirmasi banner dan data di banner dummy..
				$this->mdl_paket_manager->deleteBannerConfirmByID($id);
				$this->mdl_paket_manager->deleteBannerDummy($id_banner_dummy[0]->id_banner_dummy);
				
				$message = "Banner Telah diaktifkan";
				$this->konfirmasi($message);
				
			}
			else{
				$message = "Maaf, space / quota banner sudah penuh. banner tidak dapat dipasang.";
				$this->konfirmasi($message);
			}
		}
	}
	
	public function nonactivate($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->mdl_paket_manager->deleteBannerByID($id);
			$message = "Banner telah di nonaktifkan";
			$this->all_banner($message);
		}
	}
	
	public function banner_detail($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			$cek = $this->mdl_paket_manager->cekBannerDetail($id);
			
			if($cek){
				
				$data['banner_detail'] = $this->mdl_paket_manager->getInfoBanner($id);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/paket/submenu_banner",$data);
				$this->load->view("admin/paket/banner_detail2",$data);
				$this->load->view("admin/footer");
			}
			else{
				$data['banner_detail'] = $this->mdl_paket_manager->getBannerDetailFromTblBanner($id);
				// print_r($data['banner_detail']);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/paket/submenu_banner",$data);
				$this->load->view("admin/paket/banner_detail",$data);
				$this->load->view("admin/footer");
			}
		}
	}
	
	public function set_banner($id,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'daftar_paket';
			
			$cekBanner = $this->mdl_paket_manager->cekBannerAvailability($id);
			$data['id_info_banner'] = $id;
			
			if($cekBanner){
				
				$this->load->model('mdl_banner');
				
				$posisi = ($id < 2 ? 1 : ($id < 7 ? 2 : 3));
				$jumlahBanner = ($posisi == 1 ? 1 : ($posisi == 2 ? 5 : ($posisi == 3 ? 2 : 0)));
				
				$data['posisi_banner'] = $posisi;
				$data['harga'] = $this->mdl_banner->getBannerPriceByPosition($posisi);
				$data['userlist'] = $this->mdl_paket_manager->getAllUsername();
				
				//print_r($data['userlist']);
				
				$this->load->view("admin/header");
				$this->load->view("admin/sidebar",$data);
				$this->load->view("admin/paket/submenu_banner",$data);
				$this->load->view("admin/paket/set_banner",$data);
				$this->load->view("admin/footer");
				
				// echo "bisa pasang banner";
			}	
			else{
				$message = "Space Banner tidak tersedia.";
				$this->all_banner($message);
				
				// echo "banner unavailable";
			}
		}
	}
	
	public function do_set_banner($id_info_banner){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekBannerAvailability($id_info_banner);
			if($cek){
				$this->load->library('form_validation');
				//$this->form_validation->set_rules('posisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('url','', 'htmlentities|strip_tags|trim|xss_clean|min_length[4]|max_length[100]');
				if ($this->form_validation->run() == FALSE){
					$message =  validation_errors()."Pemesanan banner gagal. Periksa form isian anda sekali lagi.";
					$this->set_banner($id_info_banner);
				}
				else{
					
					//get posisi banner..
					// $posisi_input = $this->input->post('posisi');
					$posisi_input = $id_info_banner;
					$posisi = ($posisi_input < 2 ? 1 : ($posisi_input < 7 ? 2 : 3));
					
					//get banner_width...
					$banner_width = ($posisi == 1 ? 562 : ($posisi == 2 ? 202 : ($posisi == 3 ? 456 : "")));
					//get banner height..
					$banner_height = ($posisi == 1 ? 165 : ($posisi == 2 ? 164 : ($posisi == 3 ? 122 : "")));
					
					$this->load->library('upload');
					$this->load->library('picture');
					//if user photo exist [atribute_value][atribute]...
					if (!empty($_FILES['banner_photo']['name'])){
						$config['upload_path'] = './file/img/banner/';
						$config['allowed_types'] = 'jpg|png|gif';
						$config['max_size'] = '6000';
						$config['max_width']  = '10000';
						$config['max_height']  = '10000'; 
						$this->upload->initialize($config);
						//if member photo upload success...
						if ($this->upload->do_upload('banner_photo')){
							$data_photo 	= array('upload_data' => $this->upload->data());
							//resize image and create a new small image...
							$config_img['image_library'] 	= 'gd2';
							$config_img['source_image'] 	= $data_photo['upload_data']['full_path'];
							$config_img['quality'] 		 	= 72;
							$config_img['maintain_ratio'] 	= TRUE;
							$config_img['width']	 		= 600;
							$config_img['height']	 		= 600;
							$this->load->library('image_lib', $config_img);
							$this->image_lib->resize();
							
							//resize foto banner
							$banner_photo = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],$banner_width,$banner_height);
							
							//ambil submit date dan expired date...
							$month = $this->input->post('durasi');
							$now =  date("Y-m-d H:i:s");
							$exp = mktime(0,0,0, date("m")+$month ,date("d") , date("Y"));
							
							//cek username yang dimasukkan ada dalam database atau tidak..
							$usernameCek = $this->mdl_paket_manager->cekUserByUsername($this->input->post('username'));
							
							if($usernameCek){
								//ambil id user dari username..
								$id_user = $this->mdl_paket_manager->getIDUSerByUsername($this->input->post('username'));
								
								// insert data ke database
								$insertData = array(
									"id_info_banner" => $id_info_banner,
									"id_user" => $id_user[0]->id_user,
									"photo" => $banner_photo,
									"url" => $this->input->post('url'),
									"publish_date" => $now,
									"expired_date" => date("Y-m-d H:i:s",$exp),
									"status" => 1,
									"posisi" => $posisi
								);
							
								// print_r($insertData);
								$this->mdl_paket_manager->insertBanner($insertData);
								$message = "Banner telah terpasang";
								$this->all_banner($message);
							}
							else{
								$message = "username yang anda masukkan tidak terdaftar dalam database";
								$this->set_banner($id_info_banner,$message);
							}
						}
						else{
							$message = "upload gambar banner gagal. coba sekali lagi";
							$this->set_banner($id_info_banner,$message);
						}
					}
					else{
						$message = "file gambar banner tidak ada. pilih file banner yang ingin dipasang";
						$this->set_banner($id_info_banner,$message);
					}
					
				}
			}
			else{
				$message = "space banner tidak tersedia";
				$this->all_banner($message);
			}
		}
	}
	
	public function paket_detail($message = ''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['active'] = 'paket_detail';
			
			//ambil data semua harga paket..
			$data['paket_detail'] = $this->mdl_paket_manager->getAllHargaPaket();
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/paket/submenu_banner",$data);
			$this->load->view("admin/paket/all_paket_detail",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function new_harga_paket(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('posisi_paket','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Pembuatan paket harga baru gagal. isikan form dengan benar.";
				$this->paket_detail($message);
			}
			else{
				//insertdata ke database.
				$insertData = array(
					"posisi" => $this->input->post('posisi_paket'),
					"harga" => $this->input->post('harga'),
					"durasi" => $this->input->post('durasi') 
				);
				$this->mdl_paket_manager->newPaketHarga($insertData);
				
				$message = "Paket harga baru telah ditamabahkan";
				$this->paket_detail($message);
			}
		}
	}
	
	public function edit_harga_paket($id_harga){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekHargaPaket($id_harga);
			if($cek){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('posisi_paket','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				if ($this->form_validation->run() == FALSE){
					$message =  validation_errors()."Edit paket harga gagal. isikan form dengan benar.";
					$this->paket_detail($message);
				}
				else{
					//ambil data paket harga yang baru lalu edit ke database...
					$updateData = array(
						"posisi" => $this->input->post('posisi_paket'),
						"harga" => $this->input->post('harga'),
						"durasi" => $this->input->post('durasi') 
					);
					$this->mdl_paket_manager->updateHargaPaket($id_harga,$updateData);
					
					$message = "paket harga telah di update.";
					$this->paket_detail($message);
				}
			}
			else{
				$message = "paket harga yang dipilih tidak tersedia. ";
				$this->paket_detail($message);
			}
		}
	}
	
	public function delete_harga_paket($id_harga){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_paket_manager->cekHargaPaket($id_harga);
			if($cek){
				$this->mdl_paket_manager->deletePaketHarga($id_harga);
				$message = "paket harga berhasil dihapus. ";
				$this->paket_detail($message);
			}	
			else{
				$message = "paket harga yang ingin dihapus tidak tersedia.";
				$this->paket_detail($message);
			}
		}
	}
	
}