<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimoni extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_member');
		$this->load->model('mdl_testi');
		$this->load->model('mdl_home');
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
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("testimoni/new_testi");
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function submit_testimoni(){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('content','', 'htmlentities|strip_tags|trim|required|min_length[20]|max_length[1000]|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Submit testimoni gagal gagal. Periksa form isian anda sekali lagi.";
				$this->index($message);
			}
			else{
				$now = date("Y-m-d H:i:s");
				$insertData = array(
					'id_user' => $this->session->userdata('id_user'),
					'testimoni' => $this->input->post('content'),
					'status_testi' => 0,
					'tanggal' => $now,
				);
				$this->mdl_testi->insertTesti($insertData);
				$message = "Testimoni berhasil dibuat. terima kasih atas partisispasi anda.";
				$this->testimoni_list($message);
			}
		}
	}
	
	public function testimoni_list($message=''){
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
			
			$data['testi'] = $this->mdl_testi->getMemberTesti();
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("testimoni/all_testi",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function delete($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{			
			$this->mdl_testi->deleteTesti($id);
			
			$message='Testimoni telah dihapus.';
			$this->testimoni_list($message);
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
			
			$cek = $this->mdl_testi->cekTestimoni($id);
			if($cek){
				$data['testi'] = $this->mdl_testi->getTestiDetail($id);
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_navi");
				$this->load->view("testimoni/edit_testi",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
			else{
				$this->testimoni_list();
			}
		}
	}
	
	public function do_edit($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('content','', 'htmlentities|strip_tags|trim|required|min_length[20]|max_length[1000]|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$message =  validation_errors()."Edit testimoni gagal gagal. Periksa form isian anda sekali lagi.";
				$this->edit($id,$message);
			}
			else{
				$cek = $this->mdl_testi->cekTestimoni($id);
				if($cek){
					$updateData = array(
						"testimoni" => $this->input->post('content')
					);
					$this->mdl_testi->updateTesti($id,$updateData);
					$message = "Testimoni berhasil diedit.";
					$this->testimoni_list($message);
				}
				else{
					$this->testimoni_list();
				}
			}
		}
	}
	
	public function testi_detail($id,$message=''){
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
			
			$cek = $this->mdl_testi->cekTestimoni($id);
			if($cek){
				$datatesti = $this->mdl_testi->getTestiDetail($id);
				$data['testi'] = array(
					"id_testimoni" => $datatesti[0]->id_testimoni,
					"testimoni" => html_entity_decode($datatesti[0]->testimoni)
				);
				
				$this->load->view("home/header_member",$data);
				$this->load->view("home/topmenu");
				$this->load->view("home/topbanner",$data);
				$this->load->view("member/member_navi");
				$this->load->view("testimoni/testi_detail",$data);
				$this->load->view("home/sidebar",$data);
				$this->load->view("home/news",$data);
				$this->load->view("home/footer");
			}
		}
	}
	
}