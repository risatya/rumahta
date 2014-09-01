<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_listing extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_member');
		$this->load->model('mdl_home');
		$this->load->model('mdl_listing');
		$this->load->model('mdl_paket_listing');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index($message=''){
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
			$data['listing'] = $this->mdl_listing->getMemberListing();
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("member/all_listing",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function pilih_paket(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('banner');
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['paket_list'] = $this->mdl_paket_listing->getAllPaketInfo();
			
			$x = 0;
			$data['member_paket'] = array();
			foreach($data['paket_list'] as $item):
				$paketdata = $this->mdl_paket_listing->getPaketMemberDetail($item->id_info_paket);
				$data['member_paket'][$x]['id_info_paket'] = $item->id_info_paket;
				$data['member_paket'][$x]['nama_paket'] = $item->nama_paket;
				$data['member_paket'][$x]['durasi'] = $item->durasi_listing;
				$data['member_paket'][$x]['id_paket'] = $paketdata[0]->id_paket;
				$data['member_paket'][$x]['quota_paket'] = $item->maks_listing;
				$data['member_paket'][$x]['quota'] = $paketdata[0]->quota;
				$x++;
			endforeach;
			
			// $x = 0;
			// foreach($data['paket_list'] as $item):
				// echo ($data['member_paket'][$x]['id_info_paket'] == null ? "null" : $data['member_paket'][$x]['id_info_paket'])."<br/>";
				// echo ($data['member_paket'][$x]['nama_paket'] == null ? "null" : $data['member_paket'][$x]['nama_paket'])."<br/>";
				// echo ($data['member_paket'][$x]['durasi'] == null ? "null" : $data['member_paket'][$x]['durasi'])."<br/>";
				// echo ($data['member_paket'][$x]['id_paket'] == null ? "null" : $data['member_paket'][$x]['id_paket'])."<br/>";
				// echo ($data['member_paket'][$x]['quota'] == null ? "null" : $data['member_paket'][$x]['quota'])."<br/><br/>";
				// $x++;
			// endforeach;
			
			
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			
			$this->load->view("paket_listing/paket_member",$data);
			
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function add_listing($id_paket,$message=''){
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
			$quota = $this->mdl_listing->getQuota($id_paket);
			if($quota[0]->quota == null){
				$this->pilih_paket();
			}
			else{
				if($quota[0]->quota < 1){
					$message = "<Strong>Tidak dapat membuat Listing baru.</strong> Quota anda tidak cukup untuk memasang listing baru.";
					$this->index($message);
				}
				else{
					$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
					$data['kategori'] = $this->mdl_listing->getCategory();
					$data['id_paket'] = $quota[0]->id_paket;
					$data['status_paket'] = $quota[0]->id_info_paket == 1 ? 0 : 1;
					
					$this->load->view("home/header_member2",$data);
					$this->load->view("home/topmenu");
					$this->load->view("home/topbanner",$data);
					$this->load->view("member/member_navi");
					$this->load->view("member/new_listing",$data);
					$this->load->view("home/sidebar",$data);
					$this->load->view("home/news",$data);
					$this->load->view("home/footer");
				}
			}
		}
	}
	
	///INI FUNCTION PALING NYIKSA SEUMUR HIDUUP!!!!! HARUUUSS DITANDAIIN!!!!
	public function save_listing($id_paket){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			
			$cekPaket = $this->mdl_listing->getQuota($id_paket);
			if($cekPaket[0]->id_paket == null){
				$this->pilih_paket();
			}
			else{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('kategori','', 'htmlentities|strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('status','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('kondisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
				$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[25]|xss_clean');
				$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
				$this->form_validation->set_rules('kodepos','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[20]|xss_clean');
				$this->form_validation->set_rules('sertifikat','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
				$this->form_validation->set_rules('mls','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
				$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
				$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
				$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
				$this->form_validation->set_rules('penghuni','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('penghuni_mayoritas','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('with_owner','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('dekat_dgn','', 'htmlentities|strip_tags|trim|xss_clean|max_length[200]');
				$this->form_validation->set_rules('jlantai','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('ktidur','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('kmandi','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('garage','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('pembantu','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('sumberair','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('ltanah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('arah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('dlistrik','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('lbangunan','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
				$this->form_validation->set_rules('furniture','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('keamanan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('banjir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('univ','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('pasar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('kendaraan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('sekolah','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('toko','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('ac','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('lift','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('parkir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('kantin','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('kmr_ac','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('lemari','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('meja','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('rakbuku','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('kipas','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('tvcable','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('shower','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('telkamar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('tmptidur','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('lcd','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('mandidlm','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('dapur','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('catering','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('internet','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('rtamu','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('parkiran','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('jammalam','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('cctv','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('prt','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('olhraga','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				$this->form_validation->set_rules('cucisetrika','', 'htmlentities|strip_tags|trim|xss_clean|integer');
				
				if ($this->form_validation->run() == FALSE){
					$message =  validation_errors()."Pemasangan listing gagal. Periksa form isian anda sekali lagi.";
					$this->add_listing($id_paket,$message);
				}
				else{
					//deklarasi variabel buat nama file foto listing ...
					$listing_photo = "";
					//tentukan folder gambar listing berdasarkan paket ...
					$paket = $this->mdl_listing->getPaket($id_paket);
					if($paket[0]->id_info_paket == 1){
						$path = './file/img/free/';
						$listing_pic_width = 91;
						$listing_pic_height = 88;
						$paket_val = $paket[0]->id_info_paket;
					}
					else{
						$path = './file/img/premium/';
						$listing_pic_width = 162;
						$listing_pic_height = 91;
						$paket_val = $paket[0]->id_info_paket;
					}
					
					$this->load->library('upload');
					$this->load->library('picture');
					//if user photo exist [atribute_value][atribute]...
					if (!empty($_FILES['listing_photo']['name'])){
						$config['upload_path'] = $path;
						$config['allowed_types'] = 'jpg|png|gif';
						$config['max_size'] = '6000';
						$config['max_width']  = '5000';
						$config['max_height']  = '5000'; 
						$this->upload->initialize($config);
						//if member photo upload success...
						if ($this->upload->do_upload('listing_photo')){
							$data_photo 	= array('upload_data' => $this->upload->data());
							//make thumbnail...
							//$listing_photo_big = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],615,340);
							$listing_photo_big = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],615,340);
							$listing_photo_thumb = $this->picture->createThumb($data_photo['upload_data']['full_path'],210,140);
							//make listing_pic for listing list...
							$listing_photo_main = $this->picture->createListPhoto($data_photo['upload_data']['full_path'],$listing_pic_width,$listing_pic_height);
						}
						else{
							$message = "<strong>Upload foto profil gagal .</strong>".$this->upload->display_errors()." harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
							$this->add_listing($id_paket,$message);
						}
					}
					
					//au ah elap, pokoknya cari nilai buat dimasukkin database.
					$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
					$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));
					// $penghuni = ($this->input->post('penghuni') == 1 ? "pria" : ($this->input->post('penghuni') == 2 ? "wanita" : ($this->input->post('penghuni') == 3 ? "karyawan" : ($this->input->post('penghuni') == 4 ? "karyawati" : ($this->input->post('penghuni') == 5 ? "Pria dan wanita" : ($this->input->post('penghuni') == 6) ? "suami istri / keluarga" : "")))));
					// $penghuni_m = ($this->input->post('penghuni_mayoritas') == 1 ? "Pelajar/mahasiswa" : ($this->input->post('penghuni_mayoritas') == 2 ? "keluarga" : ($this->input->post('penghuni_mayoritas') == 3 ? "karyawan" : ($this->input->post('penghuni_mayoritas') == 4 ? "karyawati" : ""))));
					$wowner = ($this->input->post('with_owner') == 1 ? "Ya" : "Tidak");
					$stat = ($this->input->post('status') == 1 ? "kontraktor" : ($this->input->post('status') == 2 ? "arsitektur" : ($this->input->post('status') == 3 ? "Kontraktor dan arsitektur" : ($this->input->post('status') == 4 ? "Toko bahan bangunan" : ($this->input->post('status') == 5 ? "Tukang / buruh bangunan" : "")))));
					
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
					
					$insertData = array(
						"judul" => $this->input->post('judul'),
						"alamat" => $this->input->post('alamat'),
						"harga" => $this->input->post('harga'),
						"kodepos" => $this->input->post('kodepos'),
						"sertifikat" => $this->input->post('sertifikat'),
						"kondisi" =>$kond,
						"mls" => $this->input->post('mls'),
						"dekat_dgn" => $this->input->post('dekat_dgn'),
						"jml_lantai" => $this->input->post('jlantai'),
						"jml_ktidur" => $this->input->post('ktidur'),
						"jml_kmandi" => $this->input->post('kmandi'),
						"garasi" => $this->input->post('garage'),
						"daya_listrik" => $this->input->post('dlistrik'),
						"sumber_air" => $this->input->post('sumberair'),
						"pembantu" => $this->input->post('pembantu'),
						"furniture" => $furn,
						"luas_bangunan" => $this->input->post('lbangunan'), 
						"luas_tanah" => $this->input->post('ltanah'),
						"keterangan" => $this->input->post('keterangan'),
						"latitude" => $this->input->post('latitude'),
						"longitude" => $this->input->post('longitude'),
						"zoom_level" => $this->input->post('zoom_level'),
						"show_map" => $this->input->post('show_map'),
						"mata_angin" => $this->input->post('arah'),
						"penghuni" => $this->input->post('penghuni'),
						"penghuni_mayoritas" => $this->input->post('penghuni_mayoritas'),
						"with_owner" => $wowner,
						"status" => $stat,
						"token" => $hash
					);
				
					//masukkan data ke database.
					$this->mdl_listing->insertListing($insertData);
					
					//ambil primary key nya record yg baru dii insert tadi.
					$pk = $this->mdl_listing->getPrimaryKey($hash);
					
					//ambil lama nya waktu listing per paket..
					//$interval = $this->mdl_listing->getListingInterval();
					$paketmember = $this->mdl_listing->getListingInterval($id_paket);
					$month = $this->mdl_listing->getMonthInterval($paketmember[0]->id_info_paket);
					$now =  date("Y-m-d H:i:s");
					$exp = mktime(0,0,0, date("m")+$month[0]->durasi_listing ,date("d") , date("Y"));
					
					//ambil status paket gratis atau premium.
					//$status_paket = ($interval[0]->id_info_paket == 1 ? 0 : 1);
					
					$insertData = array(
						"id_user" => $this->session->userdata("id_user"),
						"id_listing" => $pk[0]->id_listing,
						"id_kategori" => $this->input->post('kategori'),
						"id_kabupaten" => $this->input->post('kabupaten'),
						"submit_date" => $now,
						"expired_date" => date("Y-m-d H:i:s",$exp),
						"token" => $hash,
						"status_paket" => $paketmember[0]->id_info_paket,
						"status_listing" => ($paketmember[0]->id_info_paket == 1 ? 0 : 1)
					);
					$this->mdl_listing->insertListingMember($insertData);
					//ambil primary key (id_listing_member) nya record yg baru dii insert tadi.
					$pk = $this->mdl_listing->getPrimaryKey2($hash);
					
					if (!empty($_FILES['listing_photo']['name'])){
						//masukkin data photo.
						$insertData = array(
							"id_listing_member" => $pk[0]->id_listing_member,
							"listing_photo_big" => $listing_photo_big,
							"listing_photo_thumb" => $listing_photo_thumb,
							"listing_photo_list" => $listing_photo_main,
							"cover" => 1,
							"paket" => $paket_val
						);
						$this->mdl_listing->insertListingPhoto($insertData);
					}
					
					$cate = $this->input->post('kategori');
					if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
						$this->save_fasilitas_lokasi($pk[0]->id_listing_member);
					}
					else if($cate == 3 || $cate == 11){
						$this->save_fasilitas_lokasi($pk[0]->id_listing_member);
					}
					else if($cate == 5 || $cate == 13){
						$this->save_fasilitas_lokasi($pk[0]->id_listing_member);
						$this->save_fasilitas_kios($pk[0]->id_listing_member);
					}
					else if($cate == 15){
						$this->save_fasilitas_lokasi($pk[0]->id_listing_member);
						$this->save_fasilitas_kamar($pk[0]->id_listing_member);
						$this->save_fasilitas_kost($pk[0]->id_listing_member);
					}
					else{
					}
					
					//kurangi quota listing member nya.
					$quota = $this->mdl_listing->getQuota($id_paket);
					$sisa = $quota[0]->quota - 1;
					$this->mdl_listing->updateQuota($id_paket,$sisa);
					
					
					/***************************************************/
					//tambah statistik jumlah listing yang dipasang di database.
					
					$month = date("m");
					$year = date("Y");
					$this->load->model('mdl_statistik');
					$cekMonth = $this->mdl_statistik->cekStatistikMonth(1,$month,$year);
					if($cekMonth){
						//ambil data listing yang lama di database..
						$visitor = $this->mdl_statistik->getListingCount(1,$month,$year);
						//update data listing yg dipasang di database + 1..
						$updateData = array(
							"counter" => $visitor[0]->counter + 1
						);
						$this->mdl_statistik->updateListingCount($updateData,1,$month,$year);
					}
					else{
						//insert counter visitor baru ke database.
						$insertData = array(
							"tipe_statistik" => 1,
							"ket" => "Jumlah Listing yang dipasang",
							"bulan" => $month,
							"tahun" => $year,
							"counter" => 1
						);
						$this->mdl_statistik->insertListingCount($insertData);
					}
					
					/****************************************************/
					
					//tampilkan detail listing..
					$message = "<strong>Berhasil. </strong>Listing anda telah terpasang.";
					$this->listing_detail($pk[0]->id_listing_member,$message);
				}
			}
		}
	}
	
	function listing_detail($id='',$message=''){
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
			//$data['info_paket'] = $this->mdl_listing->getPaketInfo();
			$data['paket_listing'] = $this->mdl_listing->getPaketInfo2($id);
			$data['listing'] = $this->mdl_listing->getListingByID($id);
			$data['listing_photo'] = $this->mdl_listing->getListingPhotoByID($id);
			$data['listing_cover'] = $this->mdl_listing->getListingCoverByID($id);
			$cate = $data['listing'][0]->id_kategori;
			$cek = $this->mdl_listing->cekListingByID($id);
			
			$this->load->view("home/header_member2",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			
			if($cek){
				if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("member/listing_detail1",$data);
				}
				else if($cate == 3 || $cate == 11){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("member/listing_detail2",$data);
				}
				else if($cate == 5 || $cate == 13){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kios'] = $this->mdl_listing->getFasilitasKiosByID($id);
					$this->load->view("member/listing_detail3",$data);
				}
				else if($cate == 6 || $cate == 14){
					$this->load->view("member/listing_detail4",$data);
				}
				else if($cate == 7){
					$this->load->view("member/listing_detail5",$data);
				}
				else if($cate == 15){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kamar'] = $this->mdl_listing->getFasilitasKamarByID($id);
					$data['fasilitas_kost'] = $this->mdl_listing->getFasilitasKostByID($id);
					$this->load->view("member/listing_detail6",$data);
				}
				else{
				}	
			}
			else{
				$this->load->view("member/listing_notfound",$data);
			}
			
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function add_listing_photo($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			//deklarasi variabel buat nama file foto listing ...
			$listing_photo = "";
			//tentukan folder gambar listing berdasarkan paket ...
			$paket = $this->mdl_listing->getPaketInfo2($id);
			if($paket[0]->status_listing == 1){
				$path = './file/img/premium/';
				$listing_pic_width = 162;
				$listing_pic_height = 91;
			}
			else{
				$path = './file/img/free/';
				$listing_pic_width = 91;
				$listing_pic_height = 88;
			}
			
			$this->load->library('upload');
			$this->load->library('picture');
			//if user photo exist [atribute_value][atribute]...
			if (!empty($_FILES['listing_photo']['name'])){
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'jpg|png|gif';
				$config['max_size'] = '6000';
				$config['max_width']  = '5000';
				$config['max_height']  = '5000'; 
				$this->upload->initialize($config);
				//if member photo upload success...
				if ($this->upload->do_upload('listing_photo')){
					$data_photo 	= array('upload_data' => $this->upload->data());
					//make thumbnail...
					$listing_photo_big = $this->picture->resizePhoto($data_photo['upload_data']['full_path'],615,340);
					$listing_photo_thumb = $this->picture->createThumb($data_photo['upload_data']['full_path'],210,140);
					//make listing_pic for listing list...
					$listing_photo_main = $this->picture->createListPhoto($data_photo['upload_data']['full_path'],$listing_pic_width,$listing_pic_height);
					//cek cover photo.
					$cov = $this->input->post('set_cover');
					$cov = $this->security->xss_clean($cov);
					$cek = $this->mdl_listing->cekListingCoverByID($id);
					if($cek == true){
						if($cov == 1){
							$cover = 1;
							$this->mdl_listing->setOldListingCover($id);
						}
						else{
							$cover = 0;
						}
					}
					else{
						$cover = 1;
					}
					//masukkin data photo.
					$insertData = array(
						"id_listing_member" => $id,
						"listing_photo_big" => $listing_photo_big,
						"listing_photo_thumb" => $listing_photo_thumb,
						"listing_photo_list" => $listing_photo_main,
						"cover" => $cover,
						"paket" => $paket[0]->status_paket
					);
					$this->mdl_listing->insertListingPhoto($insertData);
					$message = "<strong>Upload berhasil. </strong>Gambar listing anda telah ditambahkan.";
					$this->edit($id,$message);
				}
				else{
					$message = "<strong>Upload Foto listing gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
					$this->edit($id,$message);
				}
			}
			else{
				$message = "<strong>Upload Foto listing gagal .</strong> Anda harus memilih file gambar terlebih dahulu.";
				$this->edit($id,$message);
			}
		}
	}
	
	public function delete_listing_photo($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$idlisting = $this->mdl_listing->getListingMemberID($id);
			$cek = $this->mdl_listing->cekListingByID($idlisting[0]->id_listing_member);
			if($cek){
				$namafile = $this->mdl_listing->getPhotoByID($id);
				if($namafile[0]->paket != 1){
					$path = 'file/img/premium/';
				}
				else{
					$path = 'file/img/free/';
				}
				$this->mdl_listing->deleteListingPhoto($id);
				unlink($path.$namafile[0]->listing_photo_big);
				unlink($path."thumb/".$namafile[0]->listing_photo_thumb);
				unlink($path."listing_pic/".$namafile[0]->listing_photo_list);
				
				$message = 'Foto listing telah dihapus.';
				$this->edit($idlisting[0]->id_listing_member,$message);
			}
			else{
				$this->index();
			}
		}
	}
	
	public function edit_listing_cover($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$idlisting = $this->mdl_listing->getListingMemberID($id);
			$cek = $this->mdl_listing->cekListingByID($idlisting[0]->id_listing_member);
			if($cek){
				$cekCover = $this->mdl_listing->cekListingCoverByID($idlisting[0]->id_listing_member);
				if($cekCover){
					$this->mdl_listing->setOldListingCover($idlisting[0]->id_listing_member);
				}
				$this->mdl_listing->updateCover($id);
				$message = "<strong>Cover listing anda telah diganti.</strong>";
				$this->edit($idlisting[0]->id_listing_member,$message);
			}
			else{
				$this->index();
			}
		}
	}
	
	public function delete($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('banner');
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			//$data['info_paket'] = $this->mdl_listing->getPaketInfo();
			$data['paket_listing'] = $this->mdl_listing->getPaketInfo2($id);
			$data['listing'] = $this->mdl_listing->getListingByID($id);
			$data['listing_photo'] = $this->mdl_listing->getListingPhotoByID($id);
			$data['listing_cover'] = $this->mdl_listing->getListingCoverByID($id);
			$cek = $this->mdl_listing->cekListingByID($id);
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			
			if($cek){
				$this->load->view("member/delete_listing",$data);
			}
			else{
				$this->load->view("member/listing_notfound",$data);
			}
			
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function do_delete($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$cek = $this->mdl_listing->cekListingByID($id);
			if($cek){
				//ambil id listing
				$id_listing = $this->mdl_listing->getListingID($id);
				//hapus detail listing (di tbl_listing)..
				$this->mdl_listing->deleteDetailListingByID($id_listing[0]->id_listing);
				//hapus fasilitas listing..
				$this->mdl_listing->deleteFasilitasLokasiByID($id);
				$this->mdl_listing->deleteFasilitasKiosByID($id);
				$this->mdl_listing->deleteFasilitasKamarByID($id);
				$this->mdl_listing->deleteFasilitasKostByID($id);
				//hapus listing member (tbl_listing_member)..
				$this->mdl_listing->deleteListingMemberByID($id);
				//ambil data foto listing..
				$listphoto = $this->mdl_listing->getListingPhotoByID($id);
				//hapus foto listing...
				$this->mdl_listing->deleteListingPhotoByID($id);
				if($paket[0]->id_info_paket != 1){
					$path = 'file/img/premium/';
				}
				else{
					$path = 'file/img/free/';
				}
				//hapus file foto listing...
				foreach($listphoto as $item):
					if($item->paket != 1){
						$path = 'file/img/premium/';
					}
					else{
						$path = 'file/img/free/';
					}
					unlink($path.$item->listing_photo_big);
					unlink($path."thumb/".$item->listing_photo_thumb);
					unlink($path."listing_pic/".$item->listing_photo_list);
				endforeach;
				
				$message="<strong>Listing anda telah dihapus.</strong>";
				$this->index($message);
			}
			else{
				$this->index();
			}
		}
	}
	
	public function edit($id,$message=''){
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
			//$data['info_paket'] = $this->mdl_listing->getPaketInfo();
			$data['paket_listing'] = $this->mdl_listing->getPaketInfo2($id);
			$data['listing'] = $this->mdl_listing->getListingByID($id);
			$data['listing_photo'] = $this->mdl_listing->getListingPhotoByID($id);
			$data['listing_cover'] = $this->mdl_listing->getListingCoverByID($id);
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$cate = $data['listing'][0]->id_kategori;
			$cek = $this->mdl_listing->cekListingByID($id);
			
			$this->load->view("home/header_member2",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			if($cek){
				if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("member/edit_listing1",$data);
				}
				else if($cate == 3 || $cate == 11){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("member/edit_listing2",$data);
				}
				else if($cate == 5 || $cate == 13){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kios'] = $this->mdl_listing->getFasilitasKiosByID($id);
					$this->load->view("member/edit_listing3",$data);
				}
				else if($cate == 6 || $cate == 14){
					$this->load->view("member/edit_listing4",$data);
				}
				else if($cate == 7){
					$this->load->view("member/edit_listing5",$data);
				}
				else if($cate == 15){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kamar'] = $this->mdl_listing->getFasilitasKamarByID($id);
					$data['fasilitas_kost'] = $this->mdl_listing->getFasilitasKostByID($id);
					$this->load->view("member/edit_listing6",$data);
				}
				else{
				}	
			}
			else{
				$this->load->view("member/listing_notfound",$data);
			}
			
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function do_edit1($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('kondisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('kodepos','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('sertifikat','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('mls','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
			$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
			$this->form_validation->set_rules('jlantai','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('ktidur','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kmandi','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('garage','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('pembantu','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('sumberair','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('ltanah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('arah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('dlistrik','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('lbangunan','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('furniture','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('keamanan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('banjir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('univ','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('pasar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kendaraan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('sekolah','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('toko','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit listing gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				//au ah elap, pokoknya cari nilai buat dimasukkin database.
				$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
				$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));

				$updateData = array(
					"judul" => $this->input->post('judul'),
					"alamat" => $this->input->post('alamat'),
					"harga" => $this->input->post('harga'),
					"kodepos" => $this->input->post('kodepos'),
					"sertifikat" => $this->input->post('sertifikat'),
					"latitude" => $this->input->post('latitude'),
					"longitude" => $this->input->post('longitude'),
					"zoom_level" => $this->input->post('zoom_level'),
					"show_map" => $this->input->post('show_map'),
					"kondisi" =>$kond,
					"mls" => $this->input->post('mls'),
					"jml_lantai" => $this->input->post('jlantai'),
					"jml_ktidur" => $this->input->post('ktidur'),
					"jml_kmandi" => $this->input->post('kmandi'),
					"garasi" => $this->input->post('garage'),
					"daya_listrik" => $this->input->post('dlistrik'),
					"sumber_air" => $this->input->post('sumberair'),
					"pembantu" => $this->input->post('pembantu'),
					"furniture" => $furn,
					"luas_bangunan" => $this->input->post('lbangunan'), 
					"luas_tanah" => $this->input->post('ltanah'),
					"keterangan" => $this->input->post('keterangan'),
					"mata_angin" => $this->input->post('arah'),
				);
			
				$idlisting = $this->mdl_listing->getListingID($id);
				$cek = $this->mdl_listing->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					$updateData = array(
						"keamanan" => $this->input->post('keamanan'),
						"banjir" => $this->input->post('banjir'),
						"univ" => $this->input->post('univ'),
						"pasar" => $this->input->post('pasar'),
						"kendaraan" => $this->input->post('kendaraan'),
						"sekolah" => $this->input->post('sekolah'),
						"toko" => $this->input->post('toko'),
					);
					//update fasilitas...
					$this->mdl_listing->updateFasilitasLokasi($id,$updateData);
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->listing_detail($id,$message);
				}
				else{
					$this->index();
				}
			}
		}
	}
	
	public function do_edit2($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('kondisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('kodepos','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('sertifikat','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('mls','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
			$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
			$this->form_validation->set_rules('ltanah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('arah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('keamanan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('banjir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('univ','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('pasar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kendaraan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('sekolah','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('toko','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit listing gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				//au ah elap, pokoknya cari nilai buat dimasukkin database.
				$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
				$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));

				$updateData = array(
					"judul" => $this->input->post('judul'),
					"alamat" => $this->input->post('alamat'),
					"harga" => $this->input->post('harga'),
					"kodepos" => $this->input->post('kodepos'),
					"sertifikat" => $this->input->post('sertifikat'),
					"latitude" => $this->input->post('latitude'),
					"longitude" => $this->input->post('longitude'),
					"zoom_level" => $this->input->post('zoom_level'),
					"show_map" => $this->input->post('show_map'),
					"kondisi" =>$kond,
					"mls" => $this->input->post('mls'),
					"luas_tanah" => $this->input->post('ltanah'),
					"keterangan" => $this->input->post('keterangan'),
					"mata_angin" => $this->input->post('arah'),
				);
			
				$idlisting = $this->mdl_listing->getListingID($id);
				$cek = $this->mdl_listing->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					$updateData = array(
						"keamanan" => $this->input->post('keamanan'),
						"banjir" => $this->input->post('banjir'),
						"univ" => $this->input->post('univ'),
						"pasar" => $this->input->post('pasar'),
						"kendaraan" => $this->input->post('kendaraan'),
						"sekolah" => $this->input->post('sekolah'),
						"toko" => $this->input->post('toko'),
					);
					//update fasilitas...
					$this->mdl_listing->updateFasilitasLokasi($id,$updateData);
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->listing_detail($id,$message);
				}
				else{
					$this->index();
				}
			}
		}
	}
	
	public function do_edit3($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('kondisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('kodepos','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('sertifikat','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('mls','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
			$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
			$this->form_validation->set_rules('lbangunan','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('dlistrik','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('keamanan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('banjir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('univ','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('pasar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kendaraan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('sekolah','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('toko','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('ac','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('lift','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kantin','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('parkir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit listing gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				//au ah elap, pokoknya cari nilai buat dimasukkin database.
				$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
				$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));

				$updateData = array(
					"judul" => $this->input->post('judul'),
					"alamat" => $this->input->post('alamat'),
					"harga" => $this->input->post('harga'),
					"kodepos" => $this->input->post('kodepos'),
					"sertifikat" => $this->input->post('sertifikat'),
					"latitude" => $this->input->post('latitude'),
					"longitude" => $this->input->post('longitude'),
					"zoom_level" => $this->input->post('zoom_level'),
					"show_map" => $this->input->post('show_map'),
					"kondisi" =>$kond,
					"mls" => $this->input->post('mls'),
					"luas_bangunan" => $this->input->post('lbangunan'),
					"keterangan" => $this->input->post('keterangan'),
					"daya_listrik" => $this->input->post('dlistrik'),
				);
			
				$idlisting = $this->mdl_listing->getListingID($id);
				$cek = $this->mdl_listing->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					$updateData = array(
						"keamanan" => $this->input->post('keamanan'),
						"banjir" => $this->input->post('banjir'),
						"univ" => $this->input->post('univ'),
						"pasar" => $this->input->post('pasar'),
						"kendaraan" => $this->input->post('kendaraan'),
						"sekolah" => $this->input->post('sekolah'),
						"toko" => $this->input->post('toko'),
					);
					//update fasilitas lokasi...
					$this->mdl_listing->updateFasilitasLokasi($id,$updateData);
					
					$updateData = array(
						"ac" => $this->input->post('ac'),
						"lift" => $this->input->post('lift'),
						"kantin" => $this->input->post('kantin'),
						"parkir" => $this->input->post('parkir'),
					);
					//update fasilitas kios...
					$this->mdl_listing->updateFasilitasKios($id,$updateData);
					
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->listing_detail($id,$message);
				}
				else{
					$this->index();
				}
			}
		}
	}
	
	public function do_edit4($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('kondisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
			$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
			$this->form_validation->set_rules('kodepos','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('sertifikat','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('mls','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('lbangunan','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('ltanah','', 'htmlentities|strip_tags|trim|xss_clean|max_length[20]');
			$this->form_validation->set_rules('jlantai','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit listing gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				//au ah elap, pokoknya cari nilai buat dimasukkin database.
				$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
				$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));

				$updateData = array(
					"judul" => $this->input->post('judul'),
					"alamat" => $this->input->post('alamat'),
					"harga" => $this->input->post('harga'),
					"kodepos" => $this->input->post('kodepos'),
					"sertifikat" => $this->input->post('sertifikat'),
					"latitude" => $this->input->post('latitude'),
					"longitude" => $this->input->post('longitude'),
					"zoom_level" => $this->input->post('zoom_level'),
					"show_map" => $this->input->post('show_map'),
					"kondisi" =>$kond,
					"mls" => $this->input->post('mls'),
					"luas_bangunan" => $this->input->post('lbangunan'),
					"keterangan" => $this->input->post('keterangan'),
					"luas_tanah" => $this->input->post('ltanah'),
					"jml_lantai" => $this->input->post('jlantai'),
				);
			
				$idlisting = $this->mdl_listing->getListingID($id);
				$cek = $this->mdl_listing->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->listing_detail($id,$message);
				}
				else{
					$this->index();
				}
			}
		}
	}
	
	public function do_edit5($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
			$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
			$this->form_validation->set_rules('status','', 'htmlentities|strip_tags|trim|max_length[100]|xss_clean');
			
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit listing gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				//au ah elap, pokoknya cari nilai buat dimasukkin database.
				$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
				$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));

				$updateData = array(
					"judul" => $this->input->post('judul'),
					"alamat" => $this->input->post('alamat'),
					"latitude" => $this->input->post('latitude'),
					"longitude" => $this->input->post('longitude'),
					"zoom_level" => $this->input->post('zoom_level'),
					"show_map" => $this->input->post('show_map'),
					"keterangan" => $this->input->post('keterangan'),
					"status" => $this->input->post('status'),
				);
			
				$idlisting = $this->mdl_listing->getListingID($id);
				$cek = $this->mdl_listing->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->listing_detail($id,$message);
				}
				else{
					$this->index();
				}
			}
		}
	}
	
	public function do_edit6($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('judul','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('kabupaten','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('kondisi','', 'htmlentities|strip_tags|trim|required|xss_clean|integer');
			$this->form_validation->set_rules('harga','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('alamat','', 'htmlentities|strip_tags|trim|required|min_length[4]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('kodepos','', 'htmlentities|strip_tags|trim|min_length[4]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('keterangan','', 'htmlentities|strip_tags|trim|max_length[1000]|xss_clean');
			$this->form_validation->set_rules('latitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('longitude','', 'htmlentities|strip_tags|trim|required|max_length[100]|xss_clean');
			$this->form_validation->set_rules('zoom_level','', 'htmlentities|strip_tags|trim|required|max_length[2]|xss_clean');
			$this->form_validation->set_rules('show_map','', 'htmlentities|strip_tags|trim|required|max_length[3]|xss_clean|integer');
			$this->form_validation->set_rules('penghuni','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('penghuni_mayoritas','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('with_owner','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('dekat_dgn','', 'htmlentities|strip_tags|trim|xss_clean|max_length[200]');
			$this->form_validation->set_rules('keamanan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('banjir','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('univ','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('pasar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kendaraan','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('sekolah','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('toko','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kmr_ac','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('lemari','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('meja','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('rakbuku','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('kipas','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('tvcable','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('shower','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('telkamar','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('tmptidur','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('lcd','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('mandidlm','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('dapur','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('catering','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('internet','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('rtamu','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('parkiran','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('jammalam','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('cctv','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('prt','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('olhraga','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			$this->form_validation->set_rules('cucisetrika','', 'htmlentities|strip_tags|trim|xss_clean|integer');
			
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit listing gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				//au ah elap, pokoknya cari nilai buat dimasukkin database.
				$kond = ($this->input->post('kondisi') == 1 ? "baru" : "bekas");
				$furn = ($this->input->post('furniture') == 1 ? "furnished" : ($this->input->post('furniture') == 2 ? "semi furnished" : ($this->input->post('furniture') == 3 ? "unfurnished" : "")));

				$updateData = array(
					"judul" => $this->input->post('judul'),
					"alamat" => $this->input->post('alamat'),
					"harga" => $this->input->post('harga'),
					"kodepos" => $this->input->post('kodepos'),
					"kondisi" =>$kond,
					"latitude" => $this->input->post('latitude'),
					"longitude" => $this->input->post('longitude'),
					"zoom_level" => $this->input->post('zoom_level'),
					"show_map" => $this->input->post('show_map'),
					"penghuni" => $this->input->post('penghuni'),
					"penghuni_mayoritas" => $this->input->post('penghuni_mayoritas'),
					"keterangan" => $this->input->post('keterangan'),
					"dekat_dgn" => $this->input->post('dekat_dgn'),
				);
			
				$idlisting = $this->mdl_listing->getListingID($id);
				$cek = $this->mdl_listing->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					$updateData = array(
						"keamanan" => $this->input->post('keamanan'),
						"banjir" => $this->input->post('banjir'),
						"univ" => $this->input->post('univ'),
						"pasar" => $this->input->post('pasar'),
						"kendaraan" => $this->input->post('kendaraan'),
						"sekolah" => $this->input->post('sekolah'),
						"toko" => $this->input->post('toko'),
					);
					//update fasilitas lokasi...
					$this->mdl_listing->updateFasilitasLokasi($id,$updateData);
					
					$updateData = array(
						"kmr_ac" => $this->input->post('kmr_ac'),
						"lemari" => $this->input->post('lemari'),
						"meja" => $this->input->post('meja'),
						"rakbuku" => $this->input->post('rakbuku'),
						"kipas" => $this->input->post('kipas'),
						"tvcable" => $this->input->post('tvcable'),
						"shower" => $this->input->post('shower'),
						"telkamar" => $this->input->post('telkamar'),
						"tmptidur" => $this->input->post('tmptidur'),
						"lcd" => $this->input->post('lcd'),
						"mandidlm" => $this->input->post('mandidlm'),
					);
					//update fasilitas kamar...
					$this->mdl_listing->updateFasilitasKamar($id,$updateData);
					
					$updateData = array(
						"dapur" => $this->input->post('dapur'),
						"catering" => $this->input->post('catering'),
						"internet" => $this->input->post('internet'),
						"rtamu" => $this->input->post('rtamu'),
						"parkiran" => $this->input->post('parkiran'),
						"jammalam" => $this->input->post('jammalam'),
						"cctv" => $this->input->post('cctv'),
						"prt" => $this->input->post('prt'),
						"olhraga" => $this->input->post('olhraga'),
						"cucisetrika" => $this->input->post('cucisetrika'),
					);
					//update fasilitas kost...
					$this->mdl_listing->updateFasilitasKost($id,$updateData);
					
					$message = '<strong>Edit listing berhasil.</strong>';
					//echo $this->input->post('keterangan');
					$this->listing_detail($id,$message);
				}
				else{
					$this->index();
				}
			}
		}
	}
	
	function save_fasilitas_lokasi($pk){
		$insertData = array(
			"id_listing_member" => $pk,
			"keamanan" => $this->input->post('keamanan'),
			"banjir" => $this->input->post('banjir'),
			"univ" => $this->input->post('univ'),
			"pasar" => $this->input->post('pasar'),
			"kendaraan" => $this->input->post('kendaraan'),
			"sekolah" => $this->input->post('sekolah'),
			"toko" => $this->input->post('toko'),
		);
		$this->mdl_listing->insertFasilitasLokasi($insertData);
	}

	function save_fasilitas_kios($pk){
		$insertData = array(
			"id_listing_member" => $pk,
			"ac" => $this->input->post('ac'),
			"lift" => $this->input->post('lift'),
			"parkir" => $this->input->post('parkir'),
			"kantin" => $this->input->post('kantin'),
		);
		$this->mdl_listing->insertFasilitasKios($insertData);
	}
	
	function save_fasilitas_kamar($pk){
		$insertData = array(
			"id_listing_member" => $pk,
			"kmr_ac" => $this->input->post('kmr_ac'),
			"kipas" => $this->input->post('kipas'),
			"meja" => $this->input->post('meja'),
			"rakbuku" => $this->input->post('rakbuku'),
			"tvcable" => $this->input->post('tvcable'),
			"shower" => $this->input->post('shower'),
			"telkamar" => $this->input->post('telkamar'),
			"tmptidur" => $this->input->post('tmptidur'),
			"lemari" => $this->input->post('lemari'),
			"lcd" => $this->input->post('lcd'),
			"mandidlm" => $this->input->post('mandidlm'),
		);
		$this->mdl_listing->insertFasilitasKamar($insertData);
	}
	
	function save_fasilitas_kost($pk){
		$insertData = array(
			"id_listing_member" => $pk,
			"dapur" => $this->input->post('dapur'),
			"catering" => $this->input->post('catering'),
			"internet" => $this->input->post('internet'),
			"rtamu" => $this->input->post('rtamu'),
			"parkiran" => $this->input->post('parkiran'),
			"jammalam" => $this->input->post('jammalam'),
			"cctv" => $this->input->post('cctv'),
			"prt" => $this->input->post('prt'),
			"olhraga" => $this->input->post('olhraga'),
			"cucisetrika" => $this->input->post('cucisetrika'),
		);
		$this->mdl_listing->insertFasilitasKost($insertData);
	}
	
	public function mark_listing($type,$id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$cek = $this->mdl_listing->cekListingByID($id);
			if($cek){
				$x = ($type == 1 ? 1 : 0);
				$updateData = array(
					"laku" => $x
				);
				$this->mdl_listing->markListing($id,$updateData);
				
				/***************************************************/
				//tambah / kurangi statistik jumlah listing yang laku di database.
				
				$month = date("m");
				$year = date("Y");
				$this->load->model('mdl_statistik');
				$cekMonth = $this->mdl_statistik->cekStatistikMonth(2,$month,$year);
				if($type == 1){
					if($cekMonth){
						//ambil data listing yang lama di database..
						$visitor = $this->mdl_statistik->getListingCount(2,$month,$year);
						//update data listing yg laku di database + 1..
						$updateData = array(
							"counter" => $visitor[0]->counter + 1
						);
						$this->mdl_statistik->updateListingCount($updateData,2,$month,$year);
					}
					else{
						//insert counter visitor baru ke database.
						$insertData = array(
							"tipe_statistik" => 2,
							"ket" => "Jumlah Listing yang laku",
							"bulan" => $month,
							"tahun" => $year,
							"counter" => 1
						);
						$this->mdl_statistik->insertListingCount($insertData);
					}
				}
				else{
					if($cekMonth){
						//ambil data listing yang lama di database..
						$visitor = $this->mdl_statistik->getListingCount(2,$month,$year);
						if($visitor[0]->counter > 0){
							//update data listing yg laku di database + 1..
							$updateData = array(
								"counter" => $visitor[0]->counter - 1
							);
							$this->mdl_statistik->updateListingCount($updateData,2,$month,$year);
						}
					}
				}
				/****************************************************/
				
				$message = ($type == 1 ? "Listing telah ditandai sebagai Listing yang sudah Terjual / Tersewa" : "Listing telah ditandai sebagai Listing yang belum laku");
				$this->index($message);
			}
			else{
				$this->index();
			}
		}
	}
	
}