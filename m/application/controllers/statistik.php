<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistik extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('mdl_home');
		$this->load->model('mdl_statistik');
		$this->load->model('mdl_listing');
		$this->load->model('mdl_member');
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
			
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 6; $x>=0; $x--){
				$getDate = mktime(0,0,0, date("m") ,date("d")-$x , date("Y"));
				$data['statistik'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik'][$count]['visitor'] = $this->mdl_statistik->getAllStatistikByDate(date("Y-m-d H:i:s",$getDate));
				$count++;
			}
			
			// print_r($data['statistik']);
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("statistik/all_statistik",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
	public function listing($id){
		if($this->session->userdata('logged_in') == false){
			redirect('home/index');
		}
		else{
			$this->load->library('banner');
			$data['banner'] = $this->session->userdata('bannerData');
			$data['member'] = $this->mdl_member->getUserHeaderData();
			$data['testimoni'] = $this->mdl_home->getMemberTesti();
			$data['news'] = $this->mdl_home->getMemberNews();
			
			$data['listing'] = $this->mdl_listing->getListingByID($id);
			$data['all_listing'] = $this->mdl_listing->getMemberListing();
			
			$count = 0;
			$now =  date("Y-m-d H:i:s");
			for($x = 6; $x>=0; $x--){
				$getDate = mktime(0,0,0, date("m") ,date("d")-$x , date("Y"));
				$data['statistik'][$count]['tanggal'] = date("Y-m-d H:i:s",$getDate);
				$data['statistik'][$count]['visitor'] = $this->mdl_statistik->getStatistikListingByDate($id,date("Y-m-d H:i:s",$getDate));
				$count++;
			}
			
			// print_r($data['statistik']);
			
			$this->load->view("home/header_member",$data);
			$this->load->view("home/topmenu");
			$this->load->view("home/topbanner",$data);
			$this->load->view("member/member_navi");
			$this->load->view("statistik/statistik_listing",$data);
			$this->load->view("home/sidebar",$data);
			$this->load->view("home/news",$data);
			$this->load->view("home/footer");
		}
	}
	
}