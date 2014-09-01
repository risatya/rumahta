<?php
Class Mdl_home extends CI_Model{
	
	function selectAll($table){
		return $this->db->get($table)->result();
	}
	function insertNewMember($insertData){
		$this->db->insert("tbl_user",$insertData);
	}
	function insertDefaultPaket($insertData){
		$this->db->insert("tbl_paket",$insertData);
	}
	function checkVerificationCode($param){
		$query = $this->db->get_where('tbl_user',array("verifikasi"=>$param,"status"=>0));
		if($query->num_rows() > 0){
			return 1;
		}
		else{
			$query2 = $this->db->get_where('tbl_user',array("verifikasi"=>$param,"status"=>1));
			if($query2->num_rows() > 0){
				return 2;
			}
			else{
				return 3;
			}
		}
	}
	function getIDByVerCode($ver_code){
		$this->db->select('id_user');
		$this->db->from('tbl_user');
		$this->db->where(array('verifikasi'=>$ver_code,'status'=>1));
		return $this->db->get()->result();
	}
	function activateMember($param){
		$this->db->where('verifikasi',$param);
		$this->db->update('tbl_user',array('status'=>1));
	}
	function getKabInSulsel(){
		return $this->db->get_where('tbl_kab_indo',array('id_provinsi'=>73))->result();
	}
	function getKabByID($id){
		return $this->db->get_where('tbl_kab_indo',array('id_kabupaten'=>$id))->result();
	}
	function getProvByID($id){
		return $this->db->get_where('tbl_provinsi_indo',array('id_provinsi'=>$id))->result();
	}
	function validateLogin(){
		$query = $this->db->get_where('tbl_user',array('username'=>$this->input->post('username'),'password'=>sha1($this->input->post('password'))));
		if($query->num_rows() > 0){
			$query2 = $this->db->get_where('tbl_user',array('username'=>$this->input->post('username'),'password'=>sha1($this->input->post('password')),"status"=>1));
			if($query2->num_rows() > 0){
				return "valid";
			}
			else{
				return "unconfirm";
			}
		}
		else{
			return false;
		}
	}
	
	function getIDMember($username){
		$this->db->select('id_user');
		$this->db->from('tbl_user');
		$this->db->where(array('username'=>$username));
		return $this->db->get()->result();
	}
	
	function getPremiumListingCount(){
		$now = date("Y-m-d H:i:s");
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket !=',1);
		$query = $this->db->get("tbl_listing_member");
		return $query->num_rows();
	}
	
	function getFreeListingCount(){
		$now = date("Y-m-d H:i:s");
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket',1);
		$query = $this->db->get("tbl_listing_member");
		return $query->num_rows();
	}
	
	function getPremiumListingForHome(){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket !=',1);
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit(6, 0);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getFreeListingForHome(){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket',1);
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit(6, 0);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getCoverPhotoByID($id){
		return $this->db->get_where('tbl_listing_photo',array('id_listing_member'=>$id,'cover'=>1))->result();
	}
	
	function getMemberTesti(){
		$this->db->select('*');
		$this->db->from('tbl_testimoni');
		$this->db->where(array('status_testi' => 1));
		$this->db->order_by('id_testimoni','desc');
		$this->db->limit(20, 0);
		$this->db->join('tbl_user', 'tbl_testimoni.id_user = tbl_user.id_user', 'left');
		return $this->db->get()->result();
	}
	
	function getMemberNews(){
		$this->db->select('*');
		$this->db->from('tbl_artikel');
		$this->db->where(array('status' => 1));
		$this->db->order_by('id_artikel','desc');
		$this->db->limit(20, 0);
		return $this->db->get()->result();
	}
	function cekURLUser($url){
		$query = $this->db->get_where('tbl_url',array('nama_url' => $url));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	function getUserDataByURL($url){
		return $this->db->get_where('tbl_url',array('nama_url' => $url))->result();
	}
}

