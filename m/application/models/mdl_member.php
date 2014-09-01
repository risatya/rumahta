<?php
Class Mdl_member extends CI_Model{
	
	function getUserHeaderData(){
		$this->db->select('username,user_photo,register_as');
		$this->db->from('tbl_user');
		$this->db->where(array('username'=>$this->session->userdata("username")));
		return $this->db->get()->result();
	}
	
	public function getMemberProfileByID($id){
		return $this->db->get_where("tbl_user",array("id_user"=>$id))->result();
	}
	
	function getMemberData(){
		return $this->db->get_where('tbl_user',array('username'=>$this->session->userdata("username")))->result();
	}
	
	function getOldLogo(){
		$this->db->select('company_photo');
		$this->db->from('tbl_user');
		$this->db->where(array('username'=>$this->session->userdata("username")));
		return $this->db->get()->result();
	}
	
	function getOldPhoto(){
		$this->db->select('user_photo');
		$this->db->from('tbl_user');
		$this->db->where(array('username'=>$this->session->userdata("username")));
		return $this->db->get()->result();
	}
	
	function updateMember($param){
		$this->db->where('username',$this->session->userdata("username"));
		$this->db->update('tbl_user',$param);
	}
	
	function getPassword(){
		$this->db->select('password');
		$this->db->from('tbl_user');
		$this->db->where(array('username'=>$this->session->userdata("username")));
		return $this->db->get()->result();
	}
	
	function getShortURL(){
		$this->db->select('nama_url');
		$this->db->from('tbl_url');
		$this->db->where(array('id_user'=>$this->session->userdata("id_user")));
		return $this->db->get()->result();
	}
	
	function checkURL(){
		$query = $this->db->get_where('tbl_url',array("nama_url"=>$this->input->post('url'),"id_user"=>$this->session->userdata('id_user')));
		if($query->num_rows() > 0){
			return true;
		}
	}
	
	function updateURL($param){
		$this->db->where('id_user',$this->session->userdata("id_user"));
		$this->db->update('tbl_url',$param);
	}
	
	function insertNewURL($insertData){
		$this->db->insert("tbl_url",$insertData);
	}
	
}

