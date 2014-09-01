<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paket_listing extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_member');
		$this->load->model('mdl_home');
		$this->load->model('mdl_paket_listing');
    }
	public function index($message=''){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('banner');
			$data['message'] = $message;
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			//$data['info_paket'] = $this->mdl_paket_listing->getPaketInfo();
			$data['paket_list'] = $this->mdl_paket_listing->getAllPaketInfo();
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			
			$this->load->view("paket_listing/info",$data);
			
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	public function buy($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			
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
			
			$now =  date("Y-m-d H:i:s");
			//$exp = mktime(0,0,0, date("m") ,date("d")+4 , date("Y"));
			//insert ke tabel tbl_paket_dummy...
			$insertData = array(
				"id_info_paket" => $id,
				"id_user" => $this->session->userdata("id_user"),
				"submit_date" => $now,
				//"tolerance_date" => date("Y-m-d H:i:s",$exp),
				"token" => $hash
			);
			$this->mdl_paket_listing->insertPaketDummy($insertData);
			
			$paket_dummy = $this->mdl_paket_listing->getPaketDummyByToken($hash);
			$paket = $this->mdl_paket_listing->getPaketDetail($paket_dummy[0]->id_info_paket);
			$useremail = $this->mdl_member->getMemberProfileByID($this->session->userdata("id_user"));
			
			//kirim email invoice..
			$emailconfig = array(
				'sendto' => $useremail[0]->email,
				'jenis_paket' => $paket[0]->nama_paket,
				'quota' => $paket[0]->maks_listing,
				'durasi' => $paket[0]->durasi_listing,
				'harga' => number_format($paket[0]->harga,0,",",".")
			);
			$this->load->library('invoice');
			$this->invoice->invoice_listing($emailconfig);
			
			redirect('paket_listing/invoice/'.$hash);
		}
	}
	public function invoice($token){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$cek = $this->mdl_paket_listing->cekPaketDummy($token);
			if($cek){
				$paket_dummy = $this->mdl_paket_listing->getPaketDummyByToken($token);
				
				$data['paket'] = $this->mdl_paket_listing->getPaketDetail($paket_dummy[0]->id_info_paket);
				//$data['submit_date'] = $paket_dummy[0]->submit_date;
				//$data['exp_date'] = $paket_dummy[0]->tolerance_date;
				
				$data['banner'] = $this->session->userdata('bannerData');
				$data['member'] = $this->mdl_member->getUserHeaderData();
				$data['testimoni'] = $this->mdl_home->getMemberTesti();
				$data['news'] = $this->mdl_home->getMemberNews();
				//$data['info_paket'] = $this->mdl_paket_listing->getPaketInfo();
				
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_navi");
				
				$this->load->view("paket_listing/invoice",$data);
				
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
			redirect('home/index');
		}
		else{
			$data['message'] = $message;
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			//$data['info_paket'] = $this->mdl_paket_listing->getPaketInfo();
			
			$data['konfirmasi'] = $this->mdl_paket_listing->getKonfirmasiByID();
			$this->load->view("home/header_member3",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			
			$this->load->view("paket_listing/konfirmasi",$data);
			
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	public function cancel($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$cek = $this->mdl_paket_listing->cekPaketDummyByID($id);
			if($cek){
				//hapus paket di tabel dummy...
				$this->mdl_paket_listing->deletePaketDummyByID($id);
				$message = "Pemesanan paket anda telah dibatalkan";
				$this->confirm($message);
			}
			else{
				$this->confirm();
			}
		}
	}
	public function do_confirm($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
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
				$cek = $this->mdl_paket_listing->cekPaketDummyByID($id);
				if($cek){
					//ambil data id info paket...
					$info_paket = $this->mdl_paket_listing->getIDInfoPaket($id);
					//insert data ke tabel konfirmasi...
					$insertData = array(
						"id_user" => $this->session->userdata("id_user"),
						"id_info_paket" => $info_paket[0]->id_info_paket,
						"sistem" => $this->input->post('sistem'),
						"tgl_bayar" => date("Y-m-d",strtotime($this->input->post('tanggal'))),
						"besar_bayar" => $this->input->post('besar_byr'),
						"bank_asal" => $this->input->post('bank_asal'),
						"bank_tujuan" => $this->input->post('bank_tujuan'),
						"no_rek" => $this->input->post('no_rek'),
						"pesan" => $this->input->post('pesan'),
						"confirmed" => 0
					);
					$this->mdl_paket_listing->insertKonfirmasi($insertData);
					
					//hapus data di tabel dummy.
					$this->mdl_paket_listing->deletePaketDummyByID($id);
					
					$message="Terima kasih. Konfimasi pembayaran anda telah di proses. Paket anda akan segera ditambahkan setelah administrator melakukan validasi terhadap pembayaran anda.";
					$this->confirm($message);
				}
				else{
					$this->confirm();
				}
			}
		}
	}
}