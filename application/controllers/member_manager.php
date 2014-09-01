<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_manager extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_admin');
		$this->load->model('mdl_member');
		$this->load->model('mdl_home');
		$this->load->model('mdl_listing');
		$this->load->model('mdl_listing_manager');
		
		date_default_timezone_set('Asia/Jakarta');
    }
	
	public function index(){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$this->all_member();
		}
	}
	
	public function all_member($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_user');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/member_manager/nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_member'] = $this->mdl_admin->getAllMember($config['per_page'],0);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/all_member",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function nextpage($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data semua member...
			$total_row = $this->db->count_all('tbl_user');
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/member_manager/nextpage/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$this->pagination->initialize($config);
			$data['all_member'] = $this->mdl_admin->getAllMember($config['per_page'],$this->uri->segment(3));
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/all_member",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function search_member($message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data semua member...
			$total_row = $this->mdl_admin->count_search('tbl_user',$this->input->post('keyword'));
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/member_manager/search_nextpage/'.$this->input->post('keyword').'/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$config['uri_segment']  = 4;
			$this->pagination->initialize($config);
			$data['all_member'] = $this->mdl_admin->getSearchMember($config['per_page'],0,$this->input->post('keyword'));
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/all_member",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function search_nextpage($keyword){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data semua member...
			$total_row = $this->mdl_admin->count_search('tbl_user',$keyword);
			
			//konfiguarasi paging...
			$this->load->library('pagination');
			$config['base_url'] 	= base_url().'index.php/member_manager/search_nextpage/'.$keyword.'/';
			$config['total_rows'] 	= $total_row;
			$config['per_page'] 	= 10;
			$config['first_link'] 	= 'First';
			$config['last_link'] 	= 'Last';
			$config['next_link'] 	= ' Next &raquo; ';
			$config['prev_link'] 	= ' &laquo; Prev';
			$config['uri_segment']  = 4;
			$this->pagination->initialize($config);
			$data['all_member'] = $this->mdl_admin->getSearchMember($config['per_page'],$this->uri->segment(4),$keyword);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/all_member",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function member_detail($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data member...
			$data['member_profile'] = $this->mdl_admin->getMemberDetail($id);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/member_detail",$data);
			$this->load->view("admin/footer");
		}
	}
	
	public function edit($id,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['provinsi'] = $this->mdl_home->selectAll('tbl_provinsi_indo');
			$data['kabupaten'] = $this->mdl_home->selectAll('tbl_kab_indo');
			
			//ambil data profil member..
			$data['member'] = $this->mdl_member->getMemberProfileByID($id);
			
			// print_r($data['member']);
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/member_edit",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function do_edit($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$message = validation_errors()."<strong>Pengisian form invalid .</strong> Silakan perbaiki data anda. Tanda bintang (*) harus diisi.";
				//$message = validation_errors();
				$this->edit($id,$message);
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
						$this->edit($id,$message);
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
			
				$this->mdl_admin->updateMemberByID($id,$updateData);
				$message = "<strong>Data telah di update .</strong>";
				$this->edit($id,$message);
			}
		}
	}
	
	public function delete($id){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			//hapus setiap listing member (ambil dulu listing - listing membernya)...
			$listing = $this->mdl_listing->getListingMemberByIDUser($id);
			
			//hapus faillitas, info, dan foto listing..
			foreach($listing as $item):
				$this->mdl_listing->deleteListingMemberByID($item->id_listing_member); // hapus listing member di tbl_listing_member
				$this->mdl_listing->deleteDetailListingByID($item->id_listing); //hapus listing member di tbl_listing
				$this->mdl_listing->deleteFasilitasLokasiByID($item->id_listing_member); //hapus fasillitas lokasi
				$this->mdl_listing->deleteFasilitasKiosByID($item->id_listing_member); // hapus fasilitas kios
				$this->mdl_listing->deleteFasilitasKamarByID($item->id_listing_member); // hapus fasilitas kamar
				$this->mdl_listing->deleteFasilitasKostByID($item->id_listing_member); // hapus fasilitas kost
				
				//hapus foto listing...
				$listing_foto = $this->mdl_listing->getListingPhotoByID($item->id_listing_member);
				foreach($listing_foto as $row):
					$path = ($row->paket != 1 ? 'file/img/premium/' : 'file/img/free/');
					unlink($path.$row->listing_photo_big);
					unlink($path."thumb/".$row->listing_photo_thumb);
					unlink($path."listing_pic/".$row->listing_photo_list);
				endforeach;
				
			endforeach;
			
			//hapus listing view user..
			$this->mdl_listing->deleteListingViewByID($id);
			//hapus banner dan banner_dummy user..
			$this->mdl_admin->deleteBannerByIDUser($id);
			$this->mdl_admin->deleteBannerDummyByIDUser($id);
			//hapus paket dan paket dummy user..
			$this->mdl_admin->deletePaketByIDUser($id);
			$this->mdl_admin->deletePaketDummyByIDUser($id);
			//hapus konfirmasi banner dan paket user..
			$this->mdl_admin->deleteKonfirmasiBannerByID($id);
			$this->mdl_admin->deleteKonfirmasiListingByID($id);
			//hapus testimoni member..
			$this->mdl_admin->deleteTestimoniByID($id);
			//hapus url member...
			$this->mdl_admin->deleteUrlMemberByID($id);
			//hapus info member dan foto member di tbl_user..
			$datauser = $this->mdl_member->getMemberProfileByID($id);
			$this->mdl_admin->deleteUserByID($id);
			if($datauser[0]->user_photo != null){
				unlink('file/img/pp/'.$datauser[0]->user_photo);
			}
			if($datauser[0]->company_photo != null){
				unlink('file/img/company/'.$datauser[0]->company_photo);
			}
			
			$message= "user dengan nama: ".$datauser[0]->nama." telah dihapus";
			$this->all_member($message); 
			
		}
	}
	
	public function see_listing($id,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data user
			$data['datauser'] = $this->mdl_member->getMemberProfileByID($id);
			
			$data['listing'] = $this->mdl_listing->getListingMemberByIDUser2($id);
			
			// print_r($data['listing']);
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			$this->load->view("admin/member/member_listing",$data);
			$this->load->view("admin/footer");
			
		}
	}
	
	public function listing_detail($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data / detail listing...
			$data['listing'] = $this->mdl_listing_manager->getListingByID($id);
			$data['paket_listing'] = $this->mdl_listing_manager->getPaketInfo($id);
			$data['listing_photo'] = $this->mdl_listing_manager->getListingPhotoByID($id);
			$data['listing_cover'] = $this->mdl_listing_manager->getListingCoverByID($id);
			$data['id_user'] = $id_user;
			$cate = $data['listing'][0]->id_kategori;
			$cek = $this->mdl_listing_manager->cekListingByID($id);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			
			if($cek){
				if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("admin/member/listing_detail1",$data);
				}
				else if($cate == 3 || $cate == 11){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$this->load->view("admin/member/listing_detail2",$data);
				}
				else if($cate == 5 || $cate == 13){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kios'] = $this->mdl_listing->getFasilitasKiosByID($id);
					$this->load->view("admin/member/listing_detail3",$data);
				}
				else if($cate == 6 || $cate == 14){
					$this->load->view("admin/member/listing_detail4",$data);
				}
				else if($cate == 7){
					$this->load->view("admin/member/listing_detail5",$data);
				}
				else if($cate == 15){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id);
					$data['fasilitas_kamar'] = $this->mdl_listing->getFasilitasKamarByID($id);
					$data['fasilitas_kost'] = $this->mdl_listing->getFasilitasKostByID($id);
					$this->load->view("admin/member/listing_detail6",$data);
				}
				else{
				}	
			}
			else{
				$this->load->view("admin/listing_notfound",$data);
			}
			
			$this->load->view('admin/footer');
		}
	}
	
	public function edit_listing($id_listing,$id_user,$message=''){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			
			//ambil data listing..
			$data['paket_listing'] = $this->mdl_listing_manager->getPaketInfo($id_listing);
			$data['listing'] = $this->mdl_listing_manager->getListingByID($id_listing);
			$data['listing_photo'] = $this->mdl_listing_manager->getListingPhotoByID($id_listing);
			$data['listing_cover'] = $this->mdl_listing_manager->getListingCoverByID($id_listing);
			$data['kabupaten'] = $this->mdl_home->getKabInSulsel();
			$data['id_user'] = $id_user;
			$cate = $data['listing'][0]->id_kategori;
			$cek = $this->mdl_listing->cekListingByIDListing($id_listing);
			
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			
			if($cek){
				if($cate == 1 || $cate == 2 || $cate == 4 || $cate == 9 || $cate == 10 || $cate == 12){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id_listing);
					$this->load->view("admin/member/edit_listing1",$data);
				}
				else if($cate == 3 || $cate == 11){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id_listing);
					$this->load->view("admin/member/edit_listing2",$data);
				}
				else if($cate == 5 || $cate == 13){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id_listing);
					$data['fasilitas_kios'] = $this->mdl_listing->getFasilitasKiosByID($id_listing);
					$this->load->view("admin/member/edit_listing3",$data);
				}
				else if($cate == 6 || $cate == 14){
					$this->load->view("admin/member/edit_listing4",$data);
				}
				else if($cate == 7){
					$this->load->view("admin/member/edit_listing5",$data);
				}
				else if($cate == 15){
					$data['fasilitas_lokasi'] = $this->mdl_listing->getFasilitasLokasiByID($id_listing);
					$data['fasilitas_kamar'] = $this->mdl_listing->getFasilitasKamarByID($id_listing);
					$data['fasilitas_kost'] = $this->mdl_listing->getFasilitasKostByID($id_listing);
					$this->load->view("admin/member/edit_listing6",$data);
				}
				else{
				}	
			}
			else{
				$this->load->view("admin/listing_notfound",$data);
			}
			
			$this->load->view("admin/footer");
		}
	}
	
	public function do_edit_listing1($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$this->edit_listing($id,$id_user,$message);
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
			
				$idlisting = $this->mdl_listing_manager->getListingID($id);
				$cek = $this->mdl_listing_manager->cekListingByID($id);
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
					$this->see_listing($id_user,$message);
				}
				else{
					$this->see_listing($id_user);
				}
			}
		}
	}
	
	public function do_edit_listing2($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$this->edit_listing($id,$id_user,$message);
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
			
				$idlisting = $this->mdl_listing_manager->getListingID($id);
				$cek = $this->mdl_listing_manager->cekListingByID($id);
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
					$this->see_listing($id_user,$message);
				}
				else{
					$this->see_listing($id_user);
				}
			}
		}
	}
	
	public function do_edit_listing3($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$this->edit_listing($id,$id_user,$message);
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
			
				$idlisting = $this->mdl_listing_manager->getListingID($id);
				$cek = $this->mdl_listing_manager->cekListingByID($id);
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
					$this->see_listing($id_user,$message);
				}
				else{
					$this->see_listing($id_user);
				}
			}
		}
	}
	
	public function do_edit_listing4($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$this->edit_listing($id,$id_user,$message);
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
			
				$idlisting = $this->mdl_listing_manager->getListingID($id);
				$cek = $this->mdl_listing_manager->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->see_listing($id_user,$message);
				}
				else{
					$this->see_listing($id_user);
				}
			}
		}
	}
	
	public function do_edit_listing5($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$this->edit_listing($id,$id_user,$message);
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
			
				$idlisting = $this->mdl_listing_manager->getListingID($id);
				$cek = $this->mdl_listing_manager->cekListingByID($id);
				if($cek){
					$this->mdl_listing->updateKabupaten($id,$this->input->post('kabupaten'));
					$this->mdl_listing->updateListingDetail1($idlisting[0]->id_listing,$updateData);
					
					$message = '<strong>Edit listing berhasil.</strong>';
					$this->see_listing($id_user,$message);
				}
				else{
					$this->see_listing($id_user);
				}
			}
		}
	}
	
	public function do_edit_listing6($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
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
				$this->edit_listing($id,$id_user,$message);
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
					"keterangan" => $this->input->post('keterangan'),
					"dekat_dgn" => $this->input->post('dekat_dgn'),
				);
			
				$idlisting = $this->mdl_listing_manager->getListingID($id);
				$cek = $this->mdl_listing_manager->cekListingByID($id);
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
					$this->see_listing($id_user,$message);
				}
				else{
					$this->see_listing($id_user);
				}
			}
		}
	}
	
	public function edit_listing_cover($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$idlisting = $this->mdl_listing->getListingMemberID($id);
			$cek = $this->mdl_listing_manager->cekListingByID($idlisting[0]->id_listing_member);
			if($cek){
				$cekCover = $this->mdl_listing->cekListingCoverByID($idlisting[0]->id_listing_member);
				if($cekCover){
					$this->mdl_listing->setOldListingCover($idlisting[0]->id_listing_member);
				}
				$this->mdl_listing->updateCover($id);
				$message = "<strong>Cover listing anda telah diganti.</strong>";
				$this->edit_listing($idlisting[0]->id_listing_member,$id_user,$message);
			}
			else{
				$this->see_listing($id_user);
			}
		}
	}
	
	public function delete_listing_photo($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$idlisting = $this->mdl_listing->getListingMemberID($id);
			$cek = $this->mdl_listing_manager->cekListingByID($idlisting[0]->id_listing_member);
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
				$this->edit_listing($idlisting[0]->id_listing_member,$id_user,$message);
			}
			else{
				$this->see_listing($id_user);
			}
		}
	}
	
	public function add_listing_photo($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			//deklarasi variabel buat nama file foto listing ...
			$listing_photo = "";
			//tentukan folder gambar listing berdasarkan paket ...
			$paket = $this->mdl_listing_manager->getPaket($id_user);
			if($paket[0]->id_info_paket != 1){
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
					//resize image and create a new small image...
					$config_img['image_library'] 	= 'gd2';
					$config_img['source_image'] 	= $data_photo['upload_data']['full_path'];
					$config_img['quality'] 		 	= 72;
					$config_img['maintain_ratio'] 	= TRUE;
					$config_img['width']	 		= 470;
					$config_img['height']	 		= 470;
					$this->load->library('image_lib', $config_img);
					$this->image_lib->resize();
					
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
						"paket" => $paket[0]->id_info_paket
					);
					$this->mdl_listing->insertListingPhoto($insertData);
					$message = "<strong>Upload berhasil. </strong>Gambar listing anda telah ditambahkan.";
					$this->edit_listing($id,$id_user,$message);
				}
				else{
					$message = "<strong>Upload Foto listing gagal .</strong> harap coba lagi, format file yang diperbolehkan : jpg, png, gif. Size Maksimum : 6mb.";
					$this->edit_listing($id,$id_user,$message);
				}
			}
			else{
				$message = "<strong>Upload Foto listing gagal .</strong> Anda harus memilih file gambar terlebih dahulu.";
				$this->edit_listing($id,$id_user,$message);
			}
		}
	}
	
	public function delete_listing($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$data['message'] = $message;
			$data['admin'] = $this->mdl_admin->getAdminProfile();
			$data['provinsi'] = $this->mdl_home->selectAll('tbl_provinsi_indo');
			$data['kabupaten'] = $this->mdl_home->selectAll('tbl_kab_indo');
			
			//ambil data listing member..
			$data['listing'] = $this->mdl_listing_manager->getListingByID($id);
			$data['listing_photo'] = $this->mdl_listing->getListingPhotoByID($id);
			$data['listing_cover'] = $this->mdl_listing->getListingCoverByID($id);
			$paket = $this->mdl_listing_manager->getPaket($id_user);
			$data['paket'] = $paket[0]->id_info_paket;
			$data['id_user'] = $id_user;
			$cek = $this->mdl_listing_manager->cekListingByID($id);
			
			// print_r($data['member']);
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar",$data);
			if($cek){
				$this->load->view("admin/member/member_delete",$data);
			}
			else{
				$this->load->view("admin/listing_notfound",$data);
			}
			$this->load->view("admin/footer");
		}
	}
	
	public function do_delete($id,$id_user){
		if($this->session->userdata('admin_logged_in') == false){
			redirect("rumahtadotcom/login");
		}
		else{
			$cek = $this->mdl_listing_manager->cekListingByID($id);
			if($cek){
				//ambil id listing
				$id_listing = $this->mdl_listing_manager->getListingID($id);
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
				$this->see_listing($id_user,$message);
			}
			else{
				$this->see_listing($id_user);
			}
		}
	}
	
}