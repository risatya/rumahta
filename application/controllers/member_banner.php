<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_banner extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_member');
		//$this->load->model('mdl_listing');
		$this->load->model('mdl_banner');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum memesan atau memasang iklan banner, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$data['message'] = $message;
			
			//ambil data jumlah banner yang tersedia..
			$data['topbanner'] = $this->mdl_banner->getAvailableBannerCount(1);
			$data['sidebanner'] = $this->mdl_banner->getAvailableBannerCount(2);
			$data['bottombanner'] = $this->mdl_banner->getAvailableBannerCount(3);
			
			//print_r((1 - $data['topbanner'])."   ".(5 - $data['sidebanner'])."   ".(2 - $data['bottombanner']));
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("banner/available",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function order_banner($posisi,$message=''){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum memesan atau memasang iklan banner, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			if($posisi != null){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				$data['message'] = $message;
				
				$cek = $this->mdl_banner->getAvailableBannerCount($posisi);
				$jumlahBanner = ($posisi == 1 ? 1 : ($posisi == 2 ? 5 : ($posisi == 3 ? 2 : 0)));
				if(($jumlahBanner - $cek) > 0){
					$data['posisi_banner'] = $posisi;
					$data['harga'] = $this->mdl_banner->getBannerPriceByPosition($posisi);
					
					$this->load->view("home/header_member",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_navi");
					$this->load->view("banner/form_banner",$data);
					$this->load->view("home/sidebar",$data);
					$this->load->view("home/news",$data);
					$this->load->view("home/footer");
				}
				else{
					$this->index();
				}
			}
			else{
				$this->index();
			}
		}
	}
	
	public function save_banner($posisi){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum memesan atau memasang iklan banner, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			if($posisi != null){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('posisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('durasi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('url','', 'htmlentities|strip_tags|trim|xss_clean|min_length[4]|max_length[100]');
				if ($this->form_validation->run() == FALSE){
					$message =  validation_errors()."Pemesanan banner gagal. Periksa form isian anda sekali lagi.";
					$this->order_banner($posisi,$message);
				}
				else{
					//get banner_width...
					$banner_width = ($posisi == 1 ? 560 : ($posisi == 2 ? 200 : ($posisi == 3 ? 455 : "")));
					//get banner height..
					$banner_height = ($posisi == 1 ? 165 : ($posisi == 2 ? 160 : ($posisi == 3 ? 120 : "")));
					
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
							
							//ambil submit date dan tolerance date...
							$now =  date("Y-m-d H:i:s");
							$exp = mktime(0,0,0, date("m") ,date("d")+2 , date("Y"));
							
							//generate token...
							$uid = uniqid("", true);
							$data = "";
							$data .= $_SERVER['REQUEST_TIME'];
							$data .= $_SERVER['HTTP_USER_AGENT'];
							$data .= $_SERVER['LOCAL_ADDR'];
							$data .= $_SERVER['LOCAL_PORT'];
							$data .= $_SERVER['REMOTE_ADDR'];
							$data .= $_SERVER['REMOTE_PORT'];
							$hash = strtoupper(hash('ripemd128', $uid . $guid . sha1($data)));
							
							//insert data untuk di tabel banner dummy.
							$insertData = array(
								"id_info_banner" => $this->input->post('posisi'),
								"id_user" => $this->session->userdata('id_user'),
								"id_harga" => $this->input->post('durasi'),
								"photo" => $banner_photo,
								"url" => $this->input->post('url'),
								"submit_date" => $now,
								"tolerance_date" => date("Y-m-d H:i:s",$exp),
								"token" => $hash
							);
							
							$this->mdl_banner->insertDataBannerDummy($insertData);
							
							$banner_dummy = $this->mdl_banner->getBannerDetailByToken($hash);
							$useremail = $this->mdl_member->getMemberProfileByID($this->session->userdata("id_user"));
							$a = $banner_dummy[0]->id_info_banner;
							$jenis_banner = ($a == 1 ? "banner atas" : (($a == 7 || $a == 8) ? "banner bawah ".($a-6) : "banner kanan ".($a-1)));
							
							//kirim email invoice..
							$emailconfig = array(
								'sendto' => $useremail[0]->email,
								'jenis_banner' => $jenis_banner,
								'durasi' => $banner_dummy[0]->durasi,
								'expired_date' => date('d-M-Y',strtotime($banner_dummy[0]->tolerance_date)),
								'harga' => number_format($banner_dummy[0]->harga,0,",",".")
							);
							$this->load->library('invoice');
							$this->invoice->invoice_banner($emailconfig);
							
							redirect("member_banner/invoice/".$hash);
						}
						else{
							$message = "<strong>Upload foto banner gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
							$this->order_banner($posisi,$message);
						}
					}
					else{
						$message = "anda harus upload foto banner yang ingin dipasang";
						$this->order_banner($posisi,$message);
					}
				}
			}
			else{
				$this->index();
			}
		}
	}
	
	public function invoice($token){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum memesan atau memasang iklan banner, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			$cek = $this->mdl_banner->cekBannerDummy($token);
			if($cek){
				$this->load->library('banner');
				$bannerData = $this->banner->getBannerPic();
				$this->session->set_userdata(array("bannerData"=>$bannerData));
				$data['banner'] = $this->session->userdata('bannerData');
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				
				$data['banner_dummy'] = $this->mdl_banner->getBannerDetailByToken($token);
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_navi");
				$this->load->view("banner/invoice",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
			else{
				$this->index();
			}
		}
	}
	
	public function confirm($message=''){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum konfirmasi pembayaran, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			$this->load->library('banner');
			$bannerData = $this->banner->getBannerPic();
			$this->session->set_userdata(array("bannerData"=>$bannerData));
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			$data['message'] = $message;
			
			$data['konfirmasi'] = $this->mdl_banner->getKonfirmasiByID();
			
			$this->load->view("home/header_member3",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("banner/konfirmasi",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
			
		}
	}
	
	public function do_confirm($id,$id_harga){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum konfirmasi pembayaran, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			$this->load->library('form_validation');
			if($this->input->post('sistem') == 1){
				$this->form_validation->set_rules('tanggal','', 'htmlentities|strip_tags|trim|required|max_length[10]|xss_clean');
				$this->form_validation->set_rules('sistem','', 'htmlentities|strip_tags|trim|required|integer|xss_clean');
				$this->form_validation->set_rules('besar_byr','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('bank_asal','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('no_rek','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('atas_nama','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('bank_tujuan','', 'htmlentities|strip_tags|trim|required|max_length[10]|xss_clean');
				$this->form_validation->set_rules('pesan','', 'htmlentities|strip_tags|trim|max_length[200]|xss_clean');
			}
			else{
				$this->form_validation->set_rules('tanggal','', 'htmlentities|strip_tags|trim|required|max_length[10]|xss_clean');
				$this->form_validation->set_rules('sistem','', 'htmlentities|strip_tags|trim|required|integer|xss_clean');
				$this->form_validation->set_rules('besar_byr','', 'htmlentities|strip_tags|trim|required|min_length[5]|max_length[100]|xss_clean');
			}
			if ($this->form_validation->run() == FALSE){
				$message = "<strong>Konfirmasi invalid / Gagal!.</strong> Harap coba lagi. <br/>Pastikan data yang anda isikan benar. Field dengan tanda * (bintang) harus diisi.";
				//$message = validation_errors();
				$this->confirm($message);
			}
			else{
				$cek = $this->mdl_banner->cekBannerDummyByID($id);
				if($cek){
					//ambil data id info banner dummy...
					$info_banner = $this->mdl_banner->getIDInfoBanner($id);
					//insert data ke tabel konfirmasi banner...
					$insertData = array(
						"id_user" => $this->session->userdata("id_user"),
						"id_banner_dummy" =>$id,
						"id_harga" => $id_harga,
						"sistem" => $this->input->post('sistem'),
						"tgl_bayar" => date("Y-m-d",strtotime($this->input->post('tanggal'))),
						"besar_bayar" => $this->input->post('besar_byr'),
						"bank_asal" => $this->input->post('bank_asal'),
						"bank_tujuan" => $this->input->post('bank_tujuan'),
						"no_rek" => $this->input->post('no_rek'),
						"pesan" => $this->input->post('pesan'),
						"confirmed" => 0
					);
					$this->mdl_banner->insertKonfirmasi($insertData);
					
					//hapus data di tabel dummy.
					$this->mdl_banner->updateBannerDummyByID($id);
					
					$message="Terima kasih. Konfimasi pembayaran anda telah di proses. Paket anda akan segera ditambahkan setelah administrator melakukan validasi terhadap pembayaran anda.";
					$this->confirm($message);
				}
				else{
					$this->confirm();
				}
			}
		}
	}
	
	public function cancel($id){
		if($this->session->userdata('logged_in') == false){
			$message = "Sebelum konfirmasi pembayaran, anda harus login terlebih dahulu.";
			$this->login($message);
		}
		else{
			$cek = $this->mdl_banner->cekBannerDummyByID($id);
			if($cek){
				//ambil detail member dummy untuk menghapus foto..
				$banner_dummy = $this->mdl_banner->getBannerDetailByID($id);
				//hapus foto banner...
				unlink('file/img/banner/'.$banner_dummy[0]->photo);
				
				//hapus paket di tabel dummy...
				$this->mdl_banner->deleteBannerDummyByID($id);
				$message = "Pemesanan banner anda telah dibatalkan";
				$this->confirm($message);
			}
			else{
				$this->confirm();
			}
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
			$this->index();
		}
	}
	
}